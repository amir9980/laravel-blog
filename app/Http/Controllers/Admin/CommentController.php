<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function status(Comment $comment)
    {
        Gate::authorize('status',$comment);

        $comment->is_active = !$comment->is_active;
        $comment->save();

        return back()->with(['message'=>'done']);
    }
}
