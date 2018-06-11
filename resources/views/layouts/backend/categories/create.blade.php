@extends('layouts.backend.backend')
@section('title','Criar Post - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Nova Categoria</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('categories.index')}}"><i class="fa fa-bookmark-o"></i> Categorias</a></li>
                <li class="active"><a href="{{route('categories.create')}}"><i class="fa fa-file-text"></i>Nova Categoria</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data" id="category-form">
                    @include('layouts.backend.categories.form')
                </form>
            </div>

        </section>
    </div>
@endsection

@section('script')
    <script>
        $('#title').on('keyup keypress blur change', function () {
            var title = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = title  .replace(/&/g,'-e-')
                                .replace(/[^a-z0-9-]+/g,'-')
                                .replace(/\-\-+/g,'-')
                                .replace(/^-+|-+$/g,'')
            ;
            slugInput.val(theSlug);
        });
    </script>
@endsection