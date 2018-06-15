@extends('layouts.backend.backend')
@section('title','Usuários - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Usuários</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuários</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{route('users.create')}}" class="btn btn-primary">
                                    Nova Categoria <span class="fa fa-plus"></span>
                                </a>
                            </div>
                            <div class="pull-right">

                            </div>
                        </div>
                        <div class="box-body">

                            @include('layouts.backend.partials.message')
                            @if(!$users->count())
                                <div class="alert alert-danger">
                                    Sem dados no momento
                                </div>
                            @else
                                @include('layouts.backend.users.table')
                            @endif
                        </div>

                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{$users->appends(Request::query())->links()}}
                            </div>
                            <div class="pull-right">
                                <small>{{$usersCount}} {{str_plural('Item',$usersCount)}}</small>
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