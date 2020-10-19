@extends('layouts.app')
@section('content')
<br><br>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <img class="card-img-top" src="{{ asset('storage/'.$filme->image->path)}}" alt="Card image cap">
        <h5 class="card-title">{{$filme->nome}}</h5>
        <p class="card-text">{{$filme->resumo}}</p>
        <p class="card-text">{{$filme->nota}}</p>
        <div class="row">
            <div class="col-6">
                <ul class="list-inline">
                    @foreach($filme->tags as $tag)
                    <li class="list-inline-item">
                        <h5>
                            <span class="badge badge-secondary h4">#{{$tag->name}}
                            </span>
                        </h5>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="{{route('filmes.index')}}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>


@endsection
