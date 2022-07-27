<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController as adminArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Blog\UserController as blogUserController;
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
require __DIR__."/auth.php";

require __DIR__.'/auth.php';

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::resource('article',adminArticleController::class);
    Route::get('/user/index',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/user/edit',[UserController::class,'index'])->name('admin.user.edit');
    Route::put('/user/update',[UserController::class,'index'])->name('admin.user.update');
});



// ----------------------------- home --------------------
Route::get('/', [ArticleController::class, 'index'])->name("home");
Route::get('/', [ArticleController::class, 'index']);

// ======================== articles =============================
Route::prefix("articles")->group(function () {

    // ----------------------------- single article ----------
    Route::get("/{article:slug}", [ArticleController::class, 'show'])->name('article.show');
    // ----------------------------- single bookmark ---------
    Route::match(['post', 'delete'],"/{article:slug}/bookmark", [ArticleController::class, 'bookmark'])->name('article.bookmark');
    // ----------------------------- single like -------------
    Route::match(['post', 'delete'],"/{article:slug}/like", [ArticleController::class, 'like'])->name('article.like');

});

// ======================== users ===============================
Route::prefix("users")->group(function () {
    // ----------------------------- user profile --------------
    Route::get("/{user:username}", [blogUserController::class, 'profile'])->name("user.profile");
    // ----------------------------- user articles -------------
    Route::get("/{user:username}/articles", [blogUserController::class, 'articles'])->name('user.articles');
    // ----------------------------- user edit page ------------
    Route::get("/{user:username}/edit", [blogUserController::class, 'edit'])->name("user.edit");
    // ----------------------------- user update profile -------
    Route::post("/{user:username}/update", [blogUserController::class, 'update'])->name("user.update");
});


