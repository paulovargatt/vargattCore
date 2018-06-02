<?php

namespace App\Http\Controllers;


use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index()
    {
        $posts = Post::with('author')
            ->latestFirst()
            ->published()
            ->Paginate($this->limit);
        return view('blog.index', compact('posts'));
    }

    public function category(Category $category)
    {
        //Metodo Find Categories query in Composer Service Provider
        $categoryName = $category->title;

       // \DB::enableQueryLog();
        $posts = $category->posts()
            ->with('author')
            ->latest()
            ->published()
            ->paginate($this->limit);

        return view('blog.index', compact('posts','categoryName'));
       // dd(\DB::getQueryLog());
    }

    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }
}
