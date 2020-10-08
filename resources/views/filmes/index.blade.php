@extends('layouts.app')
@section('content')


<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><br>
    <div class="d-flex align-items-center justify-content-center">

        <a class="btn btn-outline-secondary" href="{{route('filmes.create')}}">Adcionar Filme</a>


    </div>
    </div> <br> <br>
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row d-flex justify-content-around">
                @foreach($filmes as $filme)
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            @isset($filme->image)
                            <img class="card-img-top" src="{{ asset('storage/'.$filme->image->path)}}" alt="Card image cap">
                            @endisset
                            <h5 class="card-title">{{$filme->nome}}</h5>
                            <p class="card-text">{{$filme->resumo}}</p>
                            <form action="{{route('filmes.destroy', $filme->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('filmes.show', $filme->id)}}" class="btn btn-outline-secondary">Visualizar</a>
                                <a href="{{route('filmes.edit', $filme->id)}}" class="btn btn-outline-secondary">Editar</a>
                                <button type="submit" class="btn btn-outline-secondary">Excluir</button>
                            </form>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</body>

</html>

@endsection