@extends ('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('blog.alerts')
                @forelse($posts as $post)
                    <article class="post-item">
                        @if($post->image_url)
                            <div class="post-item-image">
                                <a href="{{'blog/'.$post->slug}}">
                                    <img src="{{$post->image_url}}" alt="">
                                </a>
                            </div>
                        @endif
                        <div class="post-item-body">
                            <div class="padding-10">
                                <h2><a href="{{'/blog/'.$post->slug}}">{{$post->title}}</a></h2>
                                <p>{{$post->resume}}</p>
                            </div>

                            <div class="post-meta padding-10 clearfix">
                                <div class="pull-left">
                                    <ul class="post-meta-group">
                                        <li><i class="fa fa-user"></i><a
                                                    href="{{route('blog.author',$post->author->slug)}}">{{$post->author->name}}</a>
                                        </li>
                                        <li><i class="fa fa-clock-o"></i>
                                            <time> {{$post->date}}</time>
                                        </li>
                                        <li><i class="fa fa-folder"></i><a
                                                    href="{{route('blog.category', $post->category->title)}}"> {{$post->category->title}}</a>
                                        </li>

                                        <li><i class="fa fa-tags"></i>
                                                {!! $post->tags_html !!}
                                        </li>
                                        <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('blog.show', $post->slug)}}">Continue Reading &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="alert alert-info">
                        <p>Sem Posts no momento...</p>
                    </div>
                @endforelse


                <nav>
                    {{$posts->appends(request()->only(['pesquisa']))->links()}}
                </nav>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
