<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'username'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'role'=>'nullable|string|in:user,writer,watcher,admin',
            'end_date'=>'nullable|date'
        ]);

        $users = User::query();

        $users = empty($request->username) ? $users : $users->where('username','LIKE','%'.$request->username.'%');
        $users = empty($request->status) ? $users : $users->where('is_active','=',$request->status == 'active');
        $users = empty($request->role) ? $users : $users->where('role_id','=',Role::query()->whereTitle($request->role)->first()->id);
        $users = empty($request->end_date) ? $users : $users->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());

        $users = $users->withCount(['comments','articles'=>function(Builder $query){
        }])->paginate(5)->withQueryString();

        return view('Admin.user.index',compact('users'));
    }

    public function edit(User $user)
    {
        Gate::authorize('role',$user);
        $roles = Role::all();
        return view('Admin.user.edit',compact('user','roles'));
    }

    public function update(Request $request,User $user)
    {
        $request->validate([
            'role'=>'required|string|in:user,writer,watcher,admin'
        ]);

        Gate::authorize('role',$user);

        $role = Role::query()->where('title','=',$request->role)->firstOrFail();
        $user->role_id = $role->id;
        $user->save();

        return back()->with(['message','done']);

    }

    public function status(User $user)
    {
        Gate::authorize('status',$user);

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with(['message'=>'done']);
    }

    public function articles(Request $request,User $user)
    {
        $request->validate([
            'title'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'end_date'=>'nullable|date'
        ]);

        $articles = $user->articles();

        $articles = empty($request->title) ? $articles : $articles->where('title','LIKE','%'.$request->title.'%');
        $articles = empty($request->status) ? $articles : $articles->where('is_active','=',$request->status == 'active');
        $articles = empty($request->end_date) ? $articles : $articles->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());

        $articles = $articles->paginate(5)->withQueryString();
        return view('Admin.user.articles',compact('articles'));
    }

    public function comments(Request $request,User $user)
    {
        $request->validate([
            'title'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'end_date'=>'nullable|date'
        ]);

        $comments = $user->comments();

        $comments = empty($request->title) ? $comments : $comments->where('title','LIKE','%'.$request->title.'%');
        $comments = empty($request->status) ? $comments : $comments->where('is_active','=',$request->status == 'active');
        $comments = empty($request->end_date) ? $comments : $comments->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());

        $comments = $comments->paginate(5)->withQueryString();

        return view('Admin.user.comments',compact('comments'));
    }


}
