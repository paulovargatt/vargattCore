<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Post $post, Request $request)
    {
//        $data = $request->all();
//        $data['post_id'] = $post->id;
//        Comment::create($data);

        $post->comments()->create($request->all());

        return redirect()->back()->with('message', 'Comentário Criado!');
    }
}
