<div class="col-md-4">
    <aside class="right-sidebar">
        <div class="search-widget">
            <form action="{{route('index')}}">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" value="{{request('pesquisa')}}" name="pesquisa" placeholder="Procure Por">
                    <span class="input-group-btn">
                            <button class="btn btn-lg btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                          </span>
                </div>
            </form>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $categorie)
                        <li>
                            <a href="{{route('blog.category',$categorie->slug)}}"><i
                                        class="fa fa-angle-right"></i> {{$categorie->title}}</a>
                            <span class="badge pull-right">{{$categorie->posts->count()}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popularPosts as $posts)
                        <li>
                            @if($posts->image_thumb_url)
                                <div class="post-image">
                                    <a href="{{route('blog.show',$posts->slug)}}">
                                        <img src="{{$posts->image_thumb_url}}"/>
                                    </a>
                                </div>
                            @endif
                            <div class="post-body">
                                <h6><a href="{{route('blog.show',$posts->slug)}}">{{$posts->title}}</a></h6>
                                <div class="post-meta">
                                    <span>{{$posts->date}}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    <li><a href="#">PHP</a></li>
                    <li><a href="#">Codeigniter</a></li>
                    <li><a href="#">Yii</a></li>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">Ruby on Rails</a></li>
                    <li><a href="#">jQuery</a></li>
                    <li><a href="#">Vue Js</a></li>
                    <li><a href="#">React Js</a></li>
                </ul>
            </div>
        </div>
    </aside>
</div>