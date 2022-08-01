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
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date'
        ]);

        $comments = Comment::query();

        if ($request->has('title')&&!empty('title')){
            $comments = $comments->where('title','LIKE','%'.$request->title.'%');
        }
        if ($request->has('status')&&!empty('status')){
            $comments = $comments->where('status','=',$request->status);
        }
        if ($request->has('start_date')&&!empty('start_date')){
            $comments = $comments->where('created_at','>=',Jalalian::fromFormat('Y/m/d',$request->start_date)->toCarbon());
        }
        if ($request->has('end_date')&&!empty('end_date')){
            $comments = $comments->where('created_at','<=',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());
        }
        $comments = $comments->paginate(5)->withQueryString();

        return view('admin.comment.index',compact('comments'));
    }


    public function status(Request $request,Comment $comment)
    {
        $request->validate([
            'action'=>'required|in:activate,deactivate'
        ]);

        Gate::authorize('status',$comment);

        $comment->status = $request->action == 'activate' ? 'active' : 'inactive';
        $comment->save();

        return back()->with(['message'=>'done']);
    }

    public function delete(Comment $comment)
    {
        Gate::authorize('delete',$comment);
        Comment::destroy($comment->id);
        return back()->with(['message','done']);
    }
}
