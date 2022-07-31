<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'end_date'=>'nullable|date'
        ]);

        $articles = Article::query();

        $articles = empty($request->title) ? $articles : $articles->where('title','LIKE','%'.$request->title.'%');
        $articles = empty($request->status) ? $articles : $articles->where('is_active','=',$request->status == 'active');
        $articles = empty($request->end_date) ? $articles : $articles->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());
        $articles = $articles->withCount(['comments'=>function(Builder $query){
        }])->paginate(5)->withQueryString();

        return view('admin.article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        Gate::authorize('update',$article);

        //view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function status(Article $article)
    {
        Gate::authorize('status',Article::class);

        $article->is_active = !$article->is_active;
        $article->save();

        return back()->with(['message'=>'done']);
    }

    public function comments(Request $request,Article $article)
    {
        $request->validate([
            'title'=>'nullable|string|max:100',
            'status'=>'nullable|string|in:active,inactive',
            'end_date'=>'nullable|date'
        ]);

        $comments = $article->comments();

        $comments = empty($request->title) ? $comments : $comments->where('title','LIKE','%'.$request->title.'%');
        $comments = empty($request->status) ? $comments : $comments->where('is_active','=',$request->status == 'active');
        $comments = empty($request->end_date) ? $comments : $comments->where('created_at','<',Jalalian::fromFormat('Y/m/d',$request->end_date)->toCarbon());

        $comments = $comments->paginate(5)->withQueryString();
        return view('admin.article.comments',compact('comments'));
    }
}
