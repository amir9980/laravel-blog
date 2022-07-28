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


    }
    public function like(Request $request, Article $article)
    {


    }

}
