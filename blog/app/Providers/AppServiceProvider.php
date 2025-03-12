<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer(['frontend.partials.tagList', 'frontend.partials.categoryList', 'frontend.partials.listPostRecent'], function ($view) {
            $categories = Category::all();
            $tags = Tag::all();
            $posts_recent = Post::orderBy('created_at', 'desc')->take(3)->get();
            $view->with(compact('categories', 'tags', 'posts_recent'));
        });
    }
}
