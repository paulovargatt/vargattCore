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

    protected $uploadPath;


    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.image.directory'));
    }


    public function index(Request $request)
    {
        $status = $request->get('status');
        $onlyTrashed = false;

        if ($status && $status == 'Deletado') {
            $posts = Post::onlyTrashed()->with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        }
        elseif ($status == 'Publicado'){
            $posts = Post::published()->with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::published()->count();
        }
        elseif ($status == 'Agendadado'){
            $posts = Post::schedule()->with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::schedule()->count();
        }

        elseif ($status == 'Rascunho'){
            $posts = Post::draft()->with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::draft()->count();
        }
        elseif ($status == 'Meus'){
            $posts = $request->user()->posts()->with('category', 'author')

                ->paginate($this->limit);
            $postCount = $request->user()->posts()->count();
        }
        else{
            $posts = Post::with('category', 'author')
                ->latest()
                ->paginate($this->limit);
            $postCount = Post::count();
        }

        $statusList = $this->statusList($request);
        return view('layouts.backend.blog.index', compact('posts', 'postCount', 'onlyTrashed','statusList'));
    }

    private function statusList($request){
        return [
            'Meus' => $request->user()->posts()->count(),
            'Todos ' => Post::count(),
            'Publicado ' => Post::published()->count(),
            'Agendadado ' => Post::schedule()->count(),
            'Rascunho ' => Post::draft()->count(),
            'Deletado ' => Post::onlyTrashed()->count(),
        ];
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
        return redirect('/backend/blog')->with('message', 'Post Criado com sucesso');
    }

    public function handleRequest($request)
    {

        $data = $request->all();
        if ($data['published_at']) {
            $data['published_at'] = Carbon::createFromFormat('d/m/Y H:i', $data['published_at']);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUpload = $image->move($destination, $fileName);
            if ($successUpload) {
                $width = config('cms.image.thumbnail.width');
                $height = config('cms.image.thumbnail.height');

                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
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

        return view('layouts.backend.blog.edit', compact('post', 'cats'));
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
        $oldImage = $post->image;
        $data = $this->handleRequest($request);
        $post->update($data);

        if ($oldImage !== $post->image) {
            $this->removeImage($oldImage);
        }
        return redirect('/backend/blog')->with('message', 'Post Atualizado com sucesso');

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
        return redirect('/backend/blog')->with('trash-message', [' Post Movido para a lixeira', $id]);

    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', ' Post Restaurado');

    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image);
        return redirect('/backend/blog?status=trash')->with('message', ' Post Deletado');
    }


    public function removeImage($image)
    {
        if (!empty($image)) {
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }

}
