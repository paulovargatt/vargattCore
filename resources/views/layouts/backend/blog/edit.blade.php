@extends('layouts.backend.backend')
@section('title','Editar Post - Dashboard')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Editar Post</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{route('blog.index')}}"><i class="fa fa-bookmark-o"></i> Posts</a></li>
                <li class="active"><a href="{{route('blog.index')}}"><i class="fa fa-file-text"></i>Editar Post</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- O Form só envia POST (PUT Esta definido no formEdit) -->
                <form method="post" action="{{route('blog.update',$post->id)}}" enctype="multipart/form-data" id="post=form">
                    @include('layouts.backend.blog.formEdit')
                </form>
            </div>

        </section>
    </div>
@endsection

@section('script')
    <script>
        $('ul.pagination').addClass('no-margin pagination-sm');

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

        var simplemde = new SimpleMDE({ element: $("#resume")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

        $('#published_at').datetimepicker({
            locale: 'br'
        });

        $('#draft-btn').click(function (e) {
           // e.preventDefault();
            $('#published_at').val("");
            $('#post-form').submit();
        })
    </script>
@endsection