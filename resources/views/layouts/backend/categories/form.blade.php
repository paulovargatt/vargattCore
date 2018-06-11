    <div class="col-xs-8 col-md-9">
        <div class="box">
            <div class="box-body">
                @if($category->exists)
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                @else
                    {{ csrf_field() }}
                @endif
                <div class="box-body">
                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} ">
                        <label for="title">Titulo</label>
                        <input type="text" class="form-control" value="{{old('title',$category->exists ? $category->title : null)}}" name="title" id="title" placeholder="Nome da Categoria">
                        @if($errors->has('title'))
                            <span class="help-block">{{$errors->first('title')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                        <label for="slug">Url</label>
                        <input type="text" value="{{old('slug',$category->exists ? $category->slug : '')}}" name="slug" class="form-control" id="slug" placeholder="Url">
                        @if($errors->has('slug'))
                            <span class="help-block">{{$errors->first('slug')}}</span>
                        @endif
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <div class="pull-left">
                    <button type="submit" class="btn btn-success">{{$category->exists ? 'Atualizar' : 'Salvar'}}</button>
                </div>
            </div>
        </div>
    </div>