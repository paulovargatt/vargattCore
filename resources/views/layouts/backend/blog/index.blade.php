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
                            <div class="pull-right">
                                <?php $links = [] ?>
                                @foreach($statusList as $key => $value)
                                    @if($value)
                                        <?php $links[] = "<a href=\"?status={$key}\">" . ucwords($key) . "({$value})</a> " ?>
                                        @endif
                                            @endforeach
                                        {!! implode(' | ' , $links) !!}
                            </div>
                        </div>
                        <div class="box-body">

                            @include('layouts.backend.partials.message')

                            @if(!$posts->count())
                                <div class="alert alert-danger">
                                    Sem dados no momento
                                </div>
                            @endif
                            @if($onlyTrashed)
                                @include('layouts.backend.blog.table-trash')
                            @else
                                @include('layouts.backend.blog.table')
                            @endif
                        </div>

                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{$posts->appends(Request::query())->links()}}
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