<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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

    public function show(User $user, Article $article)
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

    public function comment_store(Request $request, Article $article)
    {
        if (! auth()->check()) {
            return Redirect::route("login")->withErrors(['redirect'=>'ابتدا وارد شوید']);
        }


        $validate_data = $request->validate([
            'title' => 'required|max:65',
            'body' => 'required|max:500'
        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'title' => $validate_data['title'],
            'body' => $validate_data['body']
            ]);

        $comment->notifications()->create([]);


        return \redirect()->back()->withErrors(['commented' => 'نظر شما ثبت شد']);

    }

    public function comment_destroy(Comment $comment)
    {
        $comment->delete();
        return \redirect()->back()->withErrors(['comment_destroy' => 'دیدگاه مورد نظر حذف شد']);
    }

    public function create()
    {
        return view("main.article_create");
    }

    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:600'],
            'thumbnail' => ['required', 'image'],
            'categories' => ['required'],
            'body' => 'required',
            ]);

        $file = $request->file('thumbnail');
        $file_name = str_replace(":", "-", str_replace(" ", "-", now())) . $file->getClientOriginalName();
        $file->move(public_path('\\uploads\\imgs'), $file_name);
        $validate_data['thumbnail'] = $file_name;
        $tags = $request->validate(['tags' => ['required']])['tags'];
        unset($validate_data['categories']);
        $validate_data['category_id'] = 1;
        $validate_data['slug'] = Str::slug($validate_data['title']);
        $tags = explode(",", $tags);
        $validate_data['tags'] = json_encode($tags);
        $validate_data['user_id'] = auth()->id();
        Article::create($validate_data);
        return Redirect::route('article.show', $validate_data['slug'], ['user' => auth()->user()->username, 'article'=>$validate_data['slug']]);
    }
}
