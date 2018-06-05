@extends('layouts.backend.backend')
@section('title','Posts - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Posts</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><a href="{{route('blog.index')}}"><i class="fa fa-bookmark-o"></i> Posts</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td></td>
                                    <td>Titulo</td>
                                    <td>Autor</td>
                                    <td>Categoria</td>
                                    <td>Data</td>
                                    <td>Ações</td>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td width="150">
                                            <span title="{{$post->dateFormated(true)}}"> {{$post->dateFormated(true)}}
                                            <br>
                                                {!!  $post->publicationLabel()!!}
                                            </span>
                                        </td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->author->name}}</td>
                                        <td>{{$post->category->title}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td width="80">
                                            <a href="{{route('blog.edit',$post->id)}}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-danger">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="box-footer clearfix">
                            <div class="pull-left">
                               {{$posts->links()}}
                            </div>
                            <div class="pull-right">
                                <?php $postCount = $posts->count() ?>
                                <small>{{$postCount}} {{str_plural('Item',$postCount)}}</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
