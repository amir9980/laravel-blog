<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);

        return view('main.home', [
            'articles' => $articles,

        ]);
    }

    public function show(Article $article)
    {
        dd($article);
        return view("main.single_article", compact('article'));

    }

    public function bookmark(Request $request, Article $article)
    {
        dd($request->method(),$article->slug);
    }
    public function like(Request $request, Article $article)
    {
        dd($request->method(),$article->slug);
    }
}
