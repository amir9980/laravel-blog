<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function status(Comment $comment)
    {
        $comment->is_active = !$comment->is_active;
        $comment->save();

        return back()->with(['message'=>'done']);
    }
}
