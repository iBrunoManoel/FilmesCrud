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

        <a class="btn btn-outline-secondary" href="{{ route ('filmes.index')}}">Voltar</a>


    </div>
    </div> <br> <br>
    <table class="table table-bordered d-flex align-items-center justify-content-center">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Opções</th>

        </tr>
        @foreach($tags as $tag)
        <tr>
            <td>{{$tag->id}}</td>
            <td>{{$tag->name}}</td>
            <td>
                <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-outline-secondary">Editar</a>
                    <button type="submit" class="btn btn-outline-secondary">Excluir</button>
                </form>
                @endforeach
            </td>
        </tr>

    </table>

</body>

</html>

@endsection
