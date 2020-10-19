@extends('layouts.app')
@section('content')

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <form action="{{route('tags.store')}}" method="post">
        @csrf
        <br>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" placeholder="NOME">
        </div>

        <button type="submit" class="btn btn-outline-secondary">Adcionar</button>
        <a type="button" class="btn btn-outline-secondary" href="{{ route ('filmes.index')}}">Voltar</a> </div>
    </form>

</body>

</html>

@endsection
