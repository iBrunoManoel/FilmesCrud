@extends('layouts.app')
@section('content')
<br><br>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <img class="card-img-top" src="{{ asset('storage/'.$filme->image->path)}}" alt="Card image cap">
        <h5 class="card-title">{{$filme->nome}}</h5>
        <p class="card-text">{{$filme->resumo}}</p>
        <a href="{{route('filmes.index')}}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>


@endsection
