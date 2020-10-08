@extends('layouts.app')
@section('content')

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<body>
    <form action="{{route('filmes.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="nome" placeholder="NOME">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" name="autor" placeholder="AUTOR">
        </div>
        <div class="form-group">
            <label for="resumo">Resumo</label>
            <input type="text" class="form-control" name="resumo" placeholder="RESUMO">
        </div>
        <div class="form-group">
            <label for="Arquivo">Imagem</label>
            <input type="file" class="form-control" name="image">
        </div>
        <button type="submit" class="btn btn-outline-secondary">Adcionar</button>
        <a type="button" class="btn btn-outline-secondary" href="{{ route ('filmes.index')}}">Voltar</a> </div>
    </form>

</body>

</html>

@endsection
