<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layouts.master',function ($view){
            $view->with('usersNotification',User::query()->whereStatus('new')->count());
            $view->with('commentsNotification',Comment::query()->whereStatus('new')->count());
        });
    }
}
