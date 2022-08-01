<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
            'role' => 'nullable|string|in:user,writer,watcher,admin',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $users = User::query();
        if ($request->has('username') && !empty($request->username)) {
            $users = $users->where('username', 'LIKE', '%' . $request->username . '%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $users = $users->where('status', '=', $request->status);
        }
        if ($request->has('role') && !empty($request->role)) {
            $users = $users->where('role_id', '=', Role::query()->whereTitle($request->role)->first()->id);
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $users = $users->where('created_at', '>=', Jalalian::fromFormat('Y/m/d', $request->start_date)->toCarbon());
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $users = $users->where('created_at', '<=', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());
        }

        $users = $users->withCount(['comments', 'articles'])->paginate(5)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        Gate::authorize('role', $user);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $roles = Role::query()->pluck('title');
        $request->validate([
            'role' => ['required', 'string', Rule::in($roles)]
        ]);

        Gate::authorize('role', $user);

        $role = Role::query()->where('title', '=', $request->role)->firstOrFail();
        $user->role_id = $role->id;
        $user->save();

        return redirect()->route('admin.user.index')->with(['message', 'done']);

    }

    public function status(Request $request,User $user)
    {
        $request->validate([
            'action'=>'required|in:activate,deactivate'
        ]);

        Gate::authorize('status', $user);

        $user->status = $request->action == 'activate' ? 'active' : 'inactive';
        $user->save();

        return back()->with(['message' => 'done']);
    }

    public function articles(Request $request, User $user)
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $articles = $user->articles();

        if ($request->has('title') && !empty($request->title)) {
            $articles = $articles->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $articles = $articles->where('status', '=', $request->status);
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $articles = $articles->where('created_at', '>=', Jalalian::fromFormat('Y/m/d', $request->start_date)->toCarbon());
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $articles = $articles->where('created_at', '<=', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());
        }

        $articles = $articles->paginate(5)->withQueryString();
        return view('admin.user.articles', compact('articles'));
    }

    public function comments(Request $request, User $user)
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $comments = $user->comments();

        if ($request->has('title') && !empty($request->title)) {
            $comments = $comments->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $comments = $comments->where('status', '=', $request->status);
        }
        if ($request->has('start_date') && !empty($request->start_date)) {
            $comments = $comments->where('created_at', '>=', Jalalian::fromFormat('Y/m/d', $request->start_date)->toCarbon());
        }
        if ($request->has('end_date') && !empty($request->end_date)) {
            $comments = $comments->where('created_at', '<=', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());
        }

        $comments = $comments->paginate(5)->withQueryString();

        return view('admin.user.comments', compact('comments'));
    }


}
