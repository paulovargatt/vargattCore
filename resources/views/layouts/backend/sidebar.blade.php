<aside class="main-sidebar">
    <section class="sidebar">
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="{{Auth::user()->gravatar()}}" class="img-circle" alt="User Image">--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>{{Auth::user()->name}}</p>--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <span>Navegação:</span>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Blog</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('blog.index')}}"><i class="fa fa-bookmark-o"></i> Posts</a></li>
                    <li><a href="{{route('blog.create')}}"><i class="fa fa-plus-circle"></i> Novo </a></li>
                </ul>
            </li>
            @if(check_user_permissions(request(), "Categories@index"))
            <li><a href="{{route('categories.index')}}"><i class="fa fa-folder"></i> <span>Categorias</span></a></li>
            @endif
            @if(check_user_permissions(request(), "Users@index"))
            <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Usuários</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>