<?php

namespace App\Http\Controllers;


use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    protected $limit = 4;

    public function index()
    {
        $posts = Post::with('author','tags','category')
            ->latestFirst()
            ->filter(request('pesquisa'))
            ->published();




        $posts = $posts->paginate($this->limit);

        return view('blog.index', compact('posts'));
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;
        $posts = $category->posts()
            ->with('author','tags')
            ->latest()
            ->published()
            ->paginate($this->limit);

        return view('blog.index', compact('posts', 'categoryName'));
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->title;
        $posts = $tag->posts()
            ->with('author','category')
            ->latest()
            ->published()
            ->paginate($this->limit);

        return view('blog.index', compact('posts', 'tagName'));
    }


    public function show(Post $post)
    {
//        $viewCount = $post->view_count + 1;
//        $post->update(['view_count' => $viewCount]);

        $post->increment('view_count');
        return view('blog.show', compact('post'));
    }


    public function author(User $author)
    {
        $authorName = $author->name;
        $posts = $author->posts()
            ->with('category','tags')
            ->latest()
            ->published()
            ->paginate($this->limit);
        return view('blog.index', compact('posts', 'authorName'));
    }
}
