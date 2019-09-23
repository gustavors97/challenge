@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h2>Postagens</h2>
                </div>

                <div class="col text-center my-3">
                    <button type="button" class="btn btn-labeled btn-success m-2" onclick="window.location='{{ URL::to('posts/novo') }}'">+ Nova</button>
                </div>

                <div class="card-body mt-5">
                    <!-- <b>|| Adicione aqui uma listagem de postagens, com botão de publicar e remover ||</b> -->

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th scope="col" class="font-weight-bold text-truncate">T&iacute;tulo</th>
                                <th scope="col" class="font-weight-bold text-truncate">Ativa</th>
                                <th scope="col" class="font-weight-bold text-truncate text-center">Remover</th>
                                <th scope="col" class="font-weight-bold text-truncate text-center">Publicar</th>
                            </thead>

                            <tbody>
                                @foreach ($postagens as $postagem)
                                    <tr id="{{ $postagem->id }}">
                                        <td class="text-truncate align-middle">{{ $postagem->titulo }}</td>
                                        <td class="text-truncate align-middle">{{ $postagem->ativa }}</td>
                                        <td class="text-center"><button type="button" class="btn btn-danger btn-sm btRemover">Remover</button></td>

                                        @if ($postagem->ativa == 'S')
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm btPublicar" disabled>Publicar</button></td>
                                        @else
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm btPublicar">Publicar</button></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination justify-content-center pt-2">
                        {{ $postagens->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/script-control-publicacao.js') }}"></script>
@endpush

@endsection
