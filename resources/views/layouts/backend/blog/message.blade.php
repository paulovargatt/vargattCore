@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @elseif(session('trash-message'))
    <div class="alert alert-info d-md-inline-block" style=" display: flex">
        <?php list($message, $postId) = session('trash-message') ?>
<!--        --><?php //dd(session('trash-message')) ?>
       <span style="margin: 0 8px;">{{$message }}</span>
            <form method="post" action="{{route('blog.restore',$postId)}}">
                {{csrf_field()}} {{method_field('PUT')}}
                <button class="btn btn-xs btn-default" type="submit"> Restaurar</button>
            </form>
    </div>

@endif