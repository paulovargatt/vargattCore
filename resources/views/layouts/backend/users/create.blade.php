@extends('layouts.backend.backend')
@section('title','Criar Usuário - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Nova Usuário</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> Usuário</a></li>
                <li class="active"><a href="{{route('users.create')}}"><i class="fa fa-file-text"></i>Nova Usuário</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data" id="users-form">
                    @include('layouts.backend.users.form')
                </form>
            </div>

        </section>
    </div>
@endsection