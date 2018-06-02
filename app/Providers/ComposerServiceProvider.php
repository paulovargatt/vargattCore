<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\ServiceProvider;
use App\Category;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Injeção de metodo em todas as Views
        view()->composer('layouts.sidebar', function($view) {
            $categories = Category::with(['posts' => function($query) {
                $query->published();
            }])->orderBy('title', 'asc')->get();

            return $view->with('categories', $categories);
        });

        view()->composer('layouts.sidebar', function ($view){
            $popularPosts = Post::published()->popular()->take(3)->get();

            return $view->with('popularPosts', $popularPosts);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
