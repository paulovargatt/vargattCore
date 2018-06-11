<table class="table table-active">
    <thead>
    <tr>
        <td>Categoria</td>
        <td>Posts</td>
        <td>Ações</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $categorie)
        <tr>
            <td title="{{$categorie->title}}">{{str_limit($categorie->title,'60')}}</td>
            <td title="{{$categorie->posts->count()}}">{{$categorie->posts->count()}}</td>

            <td width="100">
                <form method="post" action="{{route('categories.destroy',$categorie->id)}}">
                    <a href="{{route('categories.edit',$categorie->id)}}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{csrf_field()}} {{method_field('DELETE')}}
                    @if($categorie->id == config('cms.default_category_id'))
                    <button disabled class="btn btn-xs btn-danger disabled" onclick="return">
                        <i class="fa fa-times"></i>
                    </button>
                        @else
                        <button onclick="return confirm('Tem certeza ?')" type="submit" class="btn btn-xs btn-danger" >
                            <i class="fa fa-times"></i>
                        </button>
                        @endif
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>