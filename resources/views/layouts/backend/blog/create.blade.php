@extends('layouts.backend.backend')
@section('title','Criar Post - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Novo Post</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('blog.index')}}"><i class="fa fa-bookmark-o"></i> Posts</a></li>
                <li class="active"><a href="{{route('blog.index')}}"><i class="fa fa-file-text"></i>Novo Post</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="box">
                        <div class="box-body">

                            <form method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} ">
                                        <label for="exampleInputEmail1">Titulo</label>
                                        <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Titulo">
                                        @if($errors->has('title'))
                                            <span class="help-block">{{$errors->first('title')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                                        <label for="slug">Url</label>
                                        <input type="text" value="{{old('slug')}}" name="slug" class="form-control" id="slug" placeholder="Url">
                                    </div>

                                    <div class="form-group {{$errors->has('resume') ? 'has-error' : ''}}">
                                        <label for="resume">Resumo</label>
                                        <textarea class="form-control" rows="2" id="resume" name="resume" placeholder="Resumo">{{old('resume')}}</textarea>
                                    </div>
                                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                                        <label for="body">Post</label>
                                        <textarea class="form-control" id="body" name="body" placeholder="Resumo">{{old('body')}}</textarea>
                                    </div>
                                    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                                        <label for="published_at">Publicar</label>
                                        <input type="text" value="{{old('published_at')}}" name="published_at" class="form-control" id="published_at" placeholder="Data">
                                        @if($errors->has('published_at'))
                                            <span class="help-block">{{$errors->first('published_at')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                                        <label for="exampleInputEmail1">Categoria</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($cats as $cat)
                                                <option name="category_id" value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                                        <label for="image">Imagem Destaque</label>
                                        <input type="file"  value="{{old('image')}}" name="image" class="form-control" id="image" placeholder="Imagem">

                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $('ul.pagination').addClass('no-margin pagination-sm')

        $('#title').on('change', function () {
            var title = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = title  .replace(/&/g,'-e-')
                                .replace(/[^a-z0-9-]+/g,'-')
                                .replace(/\-\-+/g,'-')
                                .replace(/^-+|-+$/g,'')
            ;
            slugInput.val(theSlug);
        });

        var simplemde = new SimpleMDE({ element: $("#resume")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

        $('#published_at').datetimepicker({
            locale: 'br'
        });
    </script>
@endsection