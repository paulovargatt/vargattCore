@extends('layouts.backend.backend')
@section('title','Editar Conta - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Conta</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><a href="#"><i class="fa fa-user"></i>Editar Conta</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="container">@include('layouts.backend.partials.message')</div>

                <!-- O Form só envia POST (PUT Esta definido no formEdit) -->
                <form method="post" action="{{route('editAccount')}}" enctype="multipart/form-data" id="user-form">
                    @include('layouts.backend.users.form')
                </form>
            </div>

        </section>
    </div>
@endsection