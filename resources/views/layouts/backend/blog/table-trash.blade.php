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
        <tr style="    border-left: 1px solid red;">
            <td width="190">
                <span title="">
                    {{--{{$post->published_at != null ? $post->published_at->format('d/m/Y H:m') : 'A Definir'}}--}}
                    <br>
                    {{--{!!  $post->publicationLabel()!!}--}}
                </span>
            </td>
            <td title="{{$post->title}}">{{str_limit($post->title,'50')}}</td>
            <td width="150">{{$post->author->name}}</td>
            <td width="100">{{$post->category->title}}</td>
            <td width="150">{{$post->created_at->format('d/m/y H:m')}}</td>
            <td width="100%" style="display: flex;justify-content: space-evenly">
                <form method="post" action="{{route('blog.restore',$post->id)}}">
                    {{csrf_field()}} {{method_field('PUT')}}
                    <button type="submit" class="btn btn-xs btn-success" title="Restaurar">
                        <i class="fa fa-undo"></i>
                    </button>
                </form>

                <form method="post" action="{{route('blog.forceDestroy',$post->id)}}">
                {{csrf_field()}} {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-xs btn-danger" title="Deletar PERMANENTE" onclick="confirm('Tem certeza ?')">
                        <i class="fa fa-times"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>