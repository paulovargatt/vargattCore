@extends('layouts.backend.backend')
@section('title','Posts - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Posts</h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
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
                                <ul class="pagination no-margin">
                                    <li><a href=""></a> </li>
                                    <li><a href=""></a></li>
                                    <li><a href=""></a></li>
                                    <li><a href=""></a></li>
                                    <li><a href=""></a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <small>4 Items</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
