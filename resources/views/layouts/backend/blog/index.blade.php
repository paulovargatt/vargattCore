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
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{route('blog.create')}}" class="btn btn-primary">
                                    Novo Post <span class="fa fa-plus"></span>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">

                            @include('layouts.backend.blog.message')

                            @if(!$posts->count())
                                <div class="alert alert-danger">
                                    Sem dados no momento
                                </div>
                            @endif
                            <table class="table table-active">
                                <thead>
                                <tr>
                                    <td>Publicação</td>
                                    <td>Titulo</td>
                                    <td>Autor</td>
                                    <td>Categoria</td>
                                    <td>Criado</td>
                                    <td>Ações</td>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td width="150">
                                            <span title="">
                                                {{$post->published_at != null ? $post->published_at->format('d/m/Y H:m') : 'A Definir'}}
                                                <br>
                                                {!!  $post->publicationLabel()!!}
                                            </span>
                                        </td>
                                        <td title="{{$post->title}}">{{str_limit($post->title,'50')}}</td>
                                        <td width="150">{{$post->author->name}}</td>
                                        <td width="100">{{$post->category->title}}</td>
                                        <td width="150">{{$post->created_at->format('d/m/y H:m')}}</td>
                                        <td width="100">
                                            <form method="post" action="{{route('blog.destroy',$post->id)}}">
                                            <a href="{{route('blog.edit',$post->id)}}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                                {{csrf_field()}} {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
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
                                <small>{{$postCount}} {{str_plural('Item',$postCount)}}</small>
                            </div>
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