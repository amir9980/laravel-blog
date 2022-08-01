<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Morilog\Jalali\Jalalian;

class NotificationController extends Controller
{
    public function users(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $users = User::query()->whereStatus('new');

        if ($request->has('username')&&!empty($request->username)){
            $users = $users->where('username', 'LIKE', '%' . $request->username . '%');
        }
        if ($request->has('start_date')&&!empty($request->start_date)){
            $users = $users->where('created_at', '>=', Jalalian::fromFormat('Y/m/d', $request->start_date)->toCarbon());
        }
        if ($request->has('end_date')&&!empty($request->end_date)){
            $users = $users->where('created_at', '<=', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());
        }

        $users = $users->paginate(5)->withQueryString();

        return view('admin.notification.users', compact('users'));
    }

    public function comments(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $comments = Comment::query()->whereStatus('new');
        if ($request->has('title')&&!empty($request->title)){
            $comments = $comments->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->has('start_date')&&!empty($request->start_date)){
            $comments = $comments->where('created_at', '>=', Jalalian::fromFormat('Y/m/d', $request->start_date)->toCarbon());
        }
        if ($request->has('end_date')&&!empty($request->end_date)){
            $comments = $comments->where('created_at', '<=', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());
        }

        $comments = $comments->paginate(5)->withQueryString();

        return view('admin.notification.comments', compact('comments'));
    }
}
