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
        $articles = Article::orderBy("id", "desc")->get();
        $tops = Article::all()->where("likes", ">=", 1)->sortByDesc("likes")->take(10);
        return view('main.home', [
            'articles' => $articles,
            'tops' => $tops
        ]);
    }
}
