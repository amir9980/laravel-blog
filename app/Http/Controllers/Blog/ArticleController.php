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

        $tops = Article::all()->where("likes", ">=", 1)->sortByDesc("likes")->take(10);
        return view('main.home', [
            'articles' => $articles,
            'tops' => $tops
        ]);
    }

    public function show($slug)
    {
        dd(Article::where("slug", $slug)->first());
        return view("main.single_article", [
            "article" => Article::where("slug", $slug)->first(),
        ]);

    }
}
