@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h2>{{ $postagem->titulo }}</h2>
                </div>
        
                <div class="card-body">
                    <img src="../img/posts/{{$postagem->imagem}}" class="card-img-top" alt="Post Image">

                    <p class="card-text py-2"><small class="text-muted">Postado por: {{ $postagem->name }}, em: {{ $postagem->publish_at }}</small></p>

                    <p class="card-text py-2">{{ $postagem->descricao }}</p>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
