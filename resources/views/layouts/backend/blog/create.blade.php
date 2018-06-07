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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">

                            <form role="form" method="post" href="{{route('blog.store')}}">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Titulo</label>
                                        <input type="text" class="form-control" id="title" placeholder="Titulo">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Url</label>
                                        <input type="tel" class="form-control" id="slug" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Resumo</label>
                                        <textarea class="form-control" rows="2" id="resume"
                                                  placeholder="Resumo"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Post</label>
                                        <textarea class="form-control" id="body" placeholder="Resumo"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publicar</label>
                                        <input type="text" class="form-control" id="published_at"
                                               placeholder="Publicar">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Categoria</label>
                                        <select class="form-control">
                                            <?php $cats = App\Category::all('title','id');  ?>
                                            @foreach($cats as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    </script>
@endsection