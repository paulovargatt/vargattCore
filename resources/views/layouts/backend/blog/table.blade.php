<table class="table table-active">
    <thead>
    <tr>
        <td>Publicação</td>
        <td>Titulo</td>
        <td>Autor</td>
        <td>Categoria</td>
        <td>Criado</td>
        <td>Ações</td>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td width="150">
                <span title="">
                    {{$post->published_at != null ? $post->published_at->format('d/m/Y H:m') : 'A Definir'}}
                    <br>
                    {!!  $post->publicationLabel()!!}
                </span>
            </td>
            <td title="{{$post->title}}">{{str_limit($post->title,'50')}}</td>
            <td width="150">{{$post->author->name}}</td>
            <td width="100">{{$post->category->title}}</td>
            <td width="150">{{$post->created_at->format('d/m/y H:m')}}</td>
            <td width="100">
                <form method="post" action="{{route('blog.destroy',$post->id)}}">
                    <a href="{{route('blog.edit',$post->id)}}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{csrf_field()}} {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>