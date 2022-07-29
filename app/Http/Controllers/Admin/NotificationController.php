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
            'end_date' => 'nullable|date'
        ]);

        $notifications = Notification::whereNotifiable_type(User::class)->get();
        $ids = $notifications->pluck('notifiable_id');
        if ($notifications->count() > 0) {
            $notifications->toQuery()->update(['seen' => true]);
        }
        $users = User::query();
        $users = empty($request->username) ? $users : $users->where('username', 'LIKE', '%' . $request->username . '%');
        $users = empty($request->end_date) ? $users : $users->where('created_at', '<', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());

        $users = $users->whereIn('id', $ids)->paginate(5)->withQueryString();

        return view('Admin.notification.users', compact('users'));
    }

    public function comments(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'end_date' => 'nullable|date'
        ]);

        $notifications = Notification::whereNotifiable_type(Comment::class)->get();
        $ids = $notifications->pluck('notifiable_id');
        if ($notifications->count() > 0) {
            $notifications->toQuery()->update(['seen' => true]);
        }
        $comments = Comment::query();
        $comments = empty($request->title) ? $comments : $comments->where('title', 'LIKE', '%' . $request->title . '%');
        $comments = empty($request->end_date) ? $comments : $comments->where('created_at', '<', Jalalian::fromFormat('Y/m/d', $request->end_date)->toCarbon());

        $comments = $comments->whereIn('id', $ids)->paginate(5)->withQueryString();
        return view('Admin.notification.comments', compact('comments'));
    }
}
