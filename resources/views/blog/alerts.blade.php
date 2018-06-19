
@if(isset($categoryName))
    <div class="alert alert-info">
        <p>Categoria {{$categoryName}}</p>
    </div>
@endif

@if(isset($authorName))
    <div class="alert alert-info">
        <p>Autor: {{$authorName}}</p>
    </div>
@endif

@if($pesquisa = request('pesquisa'))
    <div class="alert alert-info">
        <p>Pesquisa Por: {{$pesquisa}}</p>
    </div>
@endif
