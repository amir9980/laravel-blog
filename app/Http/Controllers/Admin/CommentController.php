<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Morilog\Jalali\Jalalian;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'end_date'=>'nullable|date'
        ]);

        $comments = Comment::query();

        $comments = empty($request->title) ? $comments : $comments->where('title','LIKE','%'.$request->title.'%');
        $comments = empty($request->status) ? $comments : $comments->where('is_active','=',$request->status == 'active');
        $comments = empty($request->end_date) ? $comments : $comments->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());

        $comments = $comments->paginate(5)->withQueryString();

        return view('admin.comment.index',compact('comments'));
    }


    public function status(Comment $comment)
    {
        Gate::authorize('status',$comment);

        $comment->is_active = !$comment->is_active;
        $comment->fresh()->notifications()->delete();
        $comment->save();

        return back()->with(['message'=>'done']);
    }

    public function delete(Comment $comment)
    {
        Gate::authorize('delete',$comment);
        $comment->notifications()->delete();
        Comment::destroy($comment->id);
        return back()->with(['message','done']);
    }
}
