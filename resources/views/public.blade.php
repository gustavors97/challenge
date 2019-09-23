@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h2>Postagens</h2>
                </div>

                <div class="card-body">
                    <!-- <b>|| Adicione aqui as postagens ativas ||</b> -->

                    @foreach ($postagens as $postagem)
                        <div class="card my-3 col-auto">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/posts/{{$postagem->imagem}}" class="card-img" alt="Post Image">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $postagem->titulo }}</h5>
                                        <p class="card-text">{{ $postagem->preview_descricao }}</p>

                                        @if ($postagem->publish_at <> null)
                                            <p class="card-text"><small class="text-muted">Publicado em: {{ $postagem->publish_at }}</small></p>
                                        @endif
                                        
                                        <a href="{{ URL::to('postagem/post_') }}{{$postagem->id}}" class="btn btn-primary">Leia mais...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pagination justify-content-center pt-2">
                        {{ $postagens->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
