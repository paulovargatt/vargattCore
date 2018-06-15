@extends('layouts.backend.backend')
@section('title','Editar Categoria - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Editar Usuário</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('categories.index')}}"><i class="fa fa-users"></i> Usuários</a></li>
                <li class="active"><a href="#"><i class="fa fa-user"></i>Editar Usuário</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- O Form só envia POST (PUT Esta definido no formEdit) -->
                <form method="post" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data" id="post=form">
                    @include('layouts.backend.users.form')
                </form>
            </div>

        </section>
    </div>
@endsection