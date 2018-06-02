<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index(){

        $posts = Post::with('author')
            ->published()
            ->latest()
            ->Paginate($this->limit);


        return view('blog.index',compact('posts'));
    }

    public function show(Post $post){
        return view('blog.show', compact('post'));
    }
}
