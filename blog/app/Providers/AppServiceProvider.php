<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
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
        View::composer(['Frontend.partials.tagList','Frontend.partials.categoryList','Frontend.partials.listPostRecent'], function ($view) {
            $categories = Category::all();
            $tags = Tag::all();
            $posts_recent = Post::orderBy('created_at', 'desc')->take(3)->get();
            $view->with(compact('categories', 'tags','posts_recent'));
        });
    }
}
