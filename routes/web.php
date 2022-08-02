<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Blog\UserController as BlogUserController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ======================== authentication ===============================
require __DIR__."/auth.php";

// ======================== admin panel ===============================
Route::prefix('admin')->middleware('can:viewAny,App\Models\User')->group(function (){
    Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::resource('article',AdminArticleController::class,['as'=>'admin']);
    Route::put('/article/{article:slug}/status',[AdminArticleController::class,'status'])->name('admin.article.status');
    Route::get('/article/{article:slug}/comments',[AdminArticleController::class,'comments'])->name('admin.article.comments');
    Route::get('/user/index',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/user/{user:username}/articles',[UserController::class,'articles'])->name('admin.user.articles');
    Route::get('/user/{user:username}/comments',[UserController::class,'comments'])->name('admin.user.comments');
    Route::get('/user/{user:username}/edit',[UserController::class,'edit'])->name('admin.user.edit');
    Route::put('/user/{user:username}/update',[UserController::class,'update'])->name('admin.user.update');
    Route::put('/user/{user:username}/status',[UserController::class,'status'])->name('admin.user.status');
    Route::get('/comment/index',[CommentController::class,'index'])->name('admin.comment.index');
    Route::put('/comment/{comment}/status',[CommentController::class,'status'])->name('admin.comment.status');
    Route::delete('/comment/{comment}/delete',[CommentController::class,'delete'])->name('admin.comment.delete');
    Route::get('notification/users',[NotificationController::class,'users'])->name('admin.notification.users');
    Route::get('notification/comments',[NotificationController::class,'comments'])->name('admin.notification.comments');
    Route::get('category/index',[CategoryController::class,'index'])->name('admin.category.index');
    Route::get('category/{cat}/edit',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::get('category/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::put('category/update',[CategoryController::class,'update'])->name('admin.category.update');
});

// ----------------------------- home --------------------
Route::get('/', [ArticleController::class, 'index'])->name("home");

// ======================== articles =============================
Route::prefix("articles")->group(function () {
    // ----------------------------- single article ----------
    Route::get("/{user:username}/{article:slug}", [ArticleController::class, 'show'])->name('article.show');
    // ----------------------------- create article ----------
    Route::get("/create", [ArticleController::class, 'create'])->name('article.create')->middleware('can:create,App\Models\Article');
    // ----------------------------- ck-upload image----------
    Route::post('/ck',[ArticleController::class, 'ck_upload'])->name('ck.upload');
    // ----------------------------- store article ----------
    Route::post("/create", [ArticleController::class, 'store'])->name('article.store')->middleware('can:create,App\Models\Article');
    // ----------------------------- destroy article ----------
    Route::delete("{article:slug}/destroy", [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('can:create,App\Models\Article');
    // ----------------------------- single bookmark ---------
    Route::post("/{article:slug}/bookmark", [ArticleController::class, 'bookmark'])->name('article.bookmark');
    // ----------------------------- single like -------------
    Route::post("/{article:slug}/like", [ArticleController::class, 'like'])->name('article.like');
    // ----------------------------- create comment ----------
    Route::post('/{article:slug}/comment', [ArticleController::class, 'comment_store'])->name('comment.store');
    // ----------------------------- destroy comment----------
    Route::delete('/{comment}',[ArticleController::class, 'comment_destroy'])->name('comment.destroy');

});


// ======================== users ===============================
Route::prefix("users")->middleware("auth")->group(function () {
    // ----------------------------- user profile --------------
    Route::get("/{user:username}", [BlogUserController::class, 'profile'])->name("user.profile");
    // ----------------------------- user articles -------------
    Route::get("/{user:username}/articles", [BlogUserController::class, 'articles'])->name('user.articles');
    // ----------------------------- user edit page ------------
    Route::get("/{user:username}/edit", [BlogUserController::class, 'edit'])->name("user.edit");
    // ----------------------------- user update profile -------
    Route::put("/{user:username}/update", [BlogUserController::class, 'update'])->name("user.update");
});
