<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Admin\AdminController;

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

require __DIR__.'/auth.php';

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminController::class,'dashboard'])->name('admin.dashboard');
});



Route::get('/', [ArticleController::class, 'index']);
