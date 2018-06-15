
@extends('layouts.backend.backend')
@section('title','Deletar Usuário - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Deletar Usuário</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> Usuário</a></li>
                <li class="active"><a href=""><i class="fa fa-user-times"></i>Deletar usuário</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form method="post" action="{{route('users.destroy',$user->id)}}" enctype="multipart/form-data"
                      id="users-form">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}

                <div class="box">
                    <div class="box-body">
                        <p class="alert-danger alert">
                            Você ira deletar esse usuário: {{$user->name}}
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="delete">Deletar todo o conteúdo desse
                            usuário:
                        </p>
                        <p>
                        <input type="radio" checked name="delete_option" value="atribuir"> Atribuir conteúdo a esses usuários:
                        <select name="selected_user">
                            @foreach($users as $us)
                            <option  value="{{$us->id}}">{{$us->name}}</option>
                                @endforeach
                        </select>
                        </p>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-warning">DELETAR</button>
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
@endsection