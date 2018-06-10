<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{

    protected $limit = 7;
    protected $uploadPath;


    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }


    public function index(Request $request)
    {
        $status = $request->get('status');
       // dd($status);
        if($status && $status == 'trash')
        {
            $posts = Post::onlyTrashed()->with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        }
        else{
            $posts = Post::with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::count();
            $onlyTrashed = false;
        }

        return view('layouts.backend.blog.index', compact('posts', 'postCount','onlyTrashed'));
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
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);

        //dd($request->all('published_at'));

        $request->user()->posts()->create($data);
        return redirect('/backend/blog')->with('message','Post Criado com sucesso');
    }

    public function handleRequest($request){

        $data = $request->all();
        if($data['published_at']){
            $data['published_at'] = Carbon::createFromFormat('d/m/Y H:i', $data['published_at']);
        }
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUpload = $image->move($destination,$fileName);
            if($successUpload){
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}","_thumb.{$extension}",$fileName);

                Image::make($destination.'/'.$fileName)
                    ->resize($width,$height)
                    ->save($destination.'/'.$thumbnail);
            }

            $data['image'] = $fileName;
        }
        return $data;
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
        $post = Post::findOrFail($id);
        $cats = Category::all('title', 'id');

        return view('layouts.backend.blog.edit',compact('post','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
      $post = Post::findOrFail($id);
      $data = $this->handleRequest($request);
      $post->update($data);
        return redirect('/backend/blog')->with('message','Post Atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::findOrFail($id)->delete();
        return redirect('/backend/blog')->with('trash-message',[' Post Movido para a lixeira', $id]);

    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('/backend/blog')->with('message',' Post Restaurado');

    }

    public function forceDestroy($id){
        Post::withTrashed()->findOrFail($id)->forceDelete();
        return redirect('/backend/blog?status=trash')->with('message',' Post Deletado');
    }
}
