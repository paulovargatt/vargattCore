<div class="col-xs-8 col-md-9">
    <div class="box">
        <div class="box-body">
            @if($user->exists)
                {{ csrf_field() }}
                {{method_field('PUT')}}
            @else
                {{ csrf_field() }}
            @endif
            <div class="box-body">
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}} ">
                    <label for="name">Titulo</label>
                    <input type="text" class="form-control" value="{{old('name',$user->exists ? $user->name : null)}}"
                           name="name" id="name" placeholder="Nome">
                    @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="email">Email</label>
                    <input type="text" value="{{old('email',$user->exists ? $user->email : '')}}" name="email"
                           class="form-control" id="email" placeholder="Email">
                    @if($errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                    @endif
                </div>

                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control" id="email" placeholder="Senha">
                    @if($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                    <label for="password_confirmation">Confirme a Senha</label>
                    <input type="password" value="" name="password_confirmation" class="form-control"
                           id="password_confirmation" placeholder="Confirme a senha">
                    @if($errors->has('password_confirmation'))
                        <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                    @endif
                </div>

                <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                    <label for="role">Função</label>
                    @if($user->exists && $user->id == config('cms.default_user_id'))
                       <br> <b>{{$user->roles->first()['display_name']}}</b>
                    @else
                    <select name="role" class="form-control" id="role">
                        <?php $role = \App\Role::all('display_name', 'id')?>
                        @foreach( $role as $roles)
                            <option value="{{$roles->id}}"
                             {{$user->exists && $user->roles->first()['id'] == $roles->id ? "selected='selected'" : ''}}
                            >{{$roles->display_name}}</option>
                        @endforeach
                    </select>
                    @endif
                    @if($errors->has('role'))
                        <span class="help-block">{{$errors->first('role')}}</span>
                    @endif
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <div class="box-footer">
            <div class="pull-left">
                <button type="submit" class="btn btn-success">{{$user->exists ? 'Atualizar' : 'Salvar'}}</button>
            </div>
        </div>
    </div>
</div>