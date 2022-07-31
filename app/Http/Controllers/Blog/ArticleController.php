<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;
use function Ybazli\Faker\string;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::orderBy('id', 'desc');

        if (str_contains($request->fullUrl(), "?")) {
                foreach ($request->query as $key=>$value){
                    if ($key == "orderBy") {
                        if (!in_array($value, ['newest', 'name', 'likes'])){
                            continue;
                        }
                        if ($value == 'newest') {
                            $articles = Article::orderBy('id', 'desc');

                        } elseif ($value == 'title') {
                            $articles = Article::orderBy('title');
                        }elseif ($value == 'likes') {
                            $articles = Article::orderBy('likes', 'desc');
                        }
                     } elseif ($key == 'search') {
                        $articles = $articles->where('title','LIKE', '%'.urldecode($value).'%')->orWhere('body', 'LIKE', '%'.urldecode($value).'%')->orWhere('description', 'LIKE', '%'.urldecode($value).'%');
                    }
                }
            }
        $articles = $articles->paginate(10)->withQueryString();

        $bookmarks = auth()->check()?auth()->user()->user_bookmarks->pluck('article_id')->toArray():[];

        return view('main.home', compact('articles', 'bookmarks'));
    }

    public function show(User $user, Article $article)
    {
        $bookmarks = auth()->check()?auth()->user()->user_bookmarks->pluck('article_id')->toArray():[];
        $likes = auth()->check()?auth()->user()->user_likes->pluck('article_id')->toArray():[];
        $user = $article->user;

        return view('main.single_article', compact('article','user', 'bookmarks', 'likes'));

    }

    public function bookmark(Request $request, Article $article)
    {
        $request->user()->bookmarks()->toggle([$article->id]);
    }

    public function like(Request $request, Article $article)
    {
        $request->user()->likes()->toggle([$article->id]);
        $article->update(['likes' => $article->likes()->count()]);
    }

    public function comment_store(Request $request, Article $article)
    {
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
            'category_id' => ['required', Rule::in(Category::all()->pluck('id'))],
            'body' => 'required',
            ]);

        $file = $request->file('thumbnail');
        $file_name = str_replace(":", "-", str_replace(" ", "-", now())) . $file->getClientOriginalName();
        $file->move(public_path('\\uploads\\imgs'), $file_name);

        $validate_data['thumbnail'] = $file_name;
        $tags = $request->validate(['tags' => ['required']])['tags'];
        $validate_data['slug'] = Str::slug($validate_data['title']);
        $tags = explode(",", $tags);
        $validate_data['tags'] = json_encode($tags);
        $validate_data['user_id'] = auth()->id();
        Article::create($validate_data);
        return Redirect::route('article.show', ['user' => auth()->user()->username, 'article'=>$validate_data['slug']]);
    }
    public function destroy(Article $article){
        $article->delete();
        return \redirect()->back();
    }

}
