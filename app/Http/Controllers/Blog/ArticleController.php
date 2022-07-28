<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        if (auth()->check()){
            $bookmarks = auth()->user()->user_bookmarks->pluck('article_id')->toArray();
            $likes = auth()->user()->user_likes->pluck('article_id')->toArray();
        } else{
            $bookmarks = [];
            $likes = [];
        }
        return view('main.home', compact('articles', 'bookmarks', 'likes'));
    }

    public function show(Article $article)
    {
        $articles = Article::latest()->paginate(10);
        if (auth()->check()){
            $bookmarks = auth()->user()->user_bookmarks->pluck('article_id')->toArray();
            $likes = auth()->user()->user_likes->pluck('article_id')->toArray();
        } else{
            $bookmarks = [];
            $likes = [];
        }
        $user = $article->user;
        return view('main.single_article', compact('article','user', 'bookmarks', 'likes'));

    }

    public function bookmark(Request $request, Article $article)
    {
        if ($request->method() == "POST") {
            $request->user()->bookmarks()->attach([$article->id]);

        } elseif ($request->method() == "DELETE") {
            $request->user()->bookmarks()->detach([$article->id]);
        };
    }

    public function like(Request $request, Article $article)
    {
        if ($request->method() == "POST") {
            $request->user()->likes()->attach([$article->id]);

        } elseif ($request->method() == "DELETE") {
            $request->user()->likes()->detach([$article->id]);
        };

    }

}
