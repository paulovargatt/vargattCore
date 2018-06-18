<table class="table table-active">
    <thead>
    <tr>
        <td>Nome</td>
        <td>Email</td>
        <td>Função</td>
        <td>Ações</td>
    </tr>
    </thead>
    <tbody>

    @foreach($users as $user)

        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->roles->first()['display_name']}}</td>

            <td width="100">
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($user->id == config('cms.default_user_id'))
                    <button disabled class="btn btn-xs btn-danger disabled" onclick="return">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <a href="{{route('backend.users.confirm',$user->id)}}" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>