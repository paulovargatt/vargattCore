<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends BackendController
{

    protected $limit = 7;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'author')
            ->latest()
            ->paginate($this->limit);

        $postCount = Post::count();
        return view('layouts.backend.blog.index', compact('posts', 'postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $cats = Category::all('title', 'id');

        return view('layouts.backend.blog.create', compact('posts', 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post )
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'body' => 'required',
            'published_at' => 'date_format:Y-m-d H:i:s',
            'category_id' => 'required',
        ]);

        $request->user()->posts()->create($request->all());

        return redirect('/backend/blog')->with('message','Post Criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
