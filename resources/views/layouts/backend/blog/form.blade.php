    <div class="col-xs-8 col-md-9">
        <div class="box">
            <div class="box-body">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} ">
                        <label for="exampleInputEmail1">Titulo</label>
                        <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Titulo">
                        @if($errors->has('title'))
                            <span class="help-block">{{$errors->first('title')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                        <label for="slug">Url</label>
                        <input type="text" value="{{old('slug')}}" name="slug" class="form-control" id="slug" placeholder="Url">
                        @if($errors->has('slug'))
                            <span class="help-block">{{$errors->first('slug')}}</span>
                        @endif
                    </div>

                    <div class="form-group {{$errors->has('resume') ? 'has-error' : ''}}">
                        <label for="resume">Resumo</label>
                        <textarea class="form-control" rows="2" id="resume" name="resume" placeholder="Resumo">{{old('resume')}}</textarea>
                        @if($errors->has('resume'))
                            <span class="help-block">{{$errors->first('resume')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        <label for="body">Post</label>
                        <textarea class="form-control" id="body" name="body" placeholder="Texto">{{old('body')}}</textarea>
                        @if($errors->has('body'))
                            <span class="help-block">{{$errors->first('body')}}</span>
                        @endif
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="box">
            <div class="box-body text-center">
                <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                    <label for="image">Imagem Destaque</label><br>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 230px; height: 150px;">
                            <img src="https://placehold.it/230x150&text=Selecione+Uma+Imagem">
                        </div>
                        <div>
                                                <span class="btn btn-default btn-file"><span class="fileinput-new">Procurar</span><span class="fileinput-exists">Trocar</span>
                                                    <input value="{{old('image')}}" name="image" id="image" type="file" name="..."></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                        </div>
                    </div>
                </div>
                <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                    <label for="published_at">Publicar</label>
                    <input type="text" value="{{old('published_at')}}" name="published_at" class="form-control" id="published_at" placeholder="Data">
                    @if($errors->has('published_at'))
                        <span class="help-block">{{$errors->first('published_at')}}</span>
                    @endif
                </div>

                <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Categoria</label>
                    <select class="form-control" name="category_id">
                        @foreach($cats as $cat)
                            <option name="category_id" value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-success btn-sm">Publicar</button>
                </div>
                <div class="pull-left">
                    <button type="submit" id="draft-btn" class="btn btn-sm btn-default ">Salvar Rascunho</button>
                </div>
            </div>

        </div>
    </div>