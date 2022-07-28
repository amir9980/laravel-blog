<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['comments','articles'=>function(Builder $query){
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

    public function articles(User $user)
    {
        $articles = $user->articles()->paginate(5)->withQueryString();
        return view('Admin.user.articles',compact('articles'));
    }

    public function comments(User $user)
    {
        $comments = $user->comments()->paginate(5)->withQueryString();

        return view('Admin.user.comments',compact('comments'));
    }


}
