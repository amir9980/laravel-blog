<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
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


Route::prefix('admin')->group(function (){
    Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::resource('article',ArticleController::class);
    Route::get('/user/index',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/user/edit',[UserController::class,'index'])->name('admin.user.edit');
    Route::put('/user/update',[UserController::class,'index'])->name('admin.user.update');
});


Route::get('/', [ArticleController::class, 'index']);


