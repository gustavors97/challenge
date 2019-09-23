@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h2>Nova postagem</h2>
                </div>

                <div class="card-body">
                    <!-- <b>|| Adicione aqui o cadastro da postagem, campos na base de dados, tabela POSTAGEM ||</b>
                    <br>
                    <b>|| Usar AJAX no submit e uma barra de progresso (envio em % ou bytes, qualquer comunicação de andamento) ||</b> -->

                    <form id='form-postagem' class="needs-validation" novalidate enctype="multipart/form-data">
                        <div class="form-row pb-2">
                            <div class="form-group col-12">
                                <label for="inputTitulo">T&iacute;tulo:</label>
                                <input type="text" class="form-control" id="inputTitulo" name="titulo" placeholder="Informe um t&iacute;tulo para a publica&ccedil;&atilde;o" value="Lorem Ipsum Dolor">
                            </div>
                        </div>

                        <div class="form-row pb-2">
                            <div class="form-group col-12">
                                <label for="inputDescricao">*Descri&ccedil;&atilde;o:</label>
                                <textarea class="form-control" id="textareaDescricao" name="descricao" rows="7" placeholder="Escreva aqui..." required>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet convallis mauris. Donec facilisis rhoncus nisl quis rhoncus. Praesent accumsan est est, et cursus massa lacinia scelerisque. Nulla non velit ipsum. Proin facilisis, metus ac finibus imperdiet, lectus sem euismod nulla, sed ullamcorper dui est id turpis. Aenean fringilla.</textarea>
                                <div class="invalid-feedback">
                                    Por favor, informe uma descri&ccedil;&atilde;o!
                                </div>
                            </div>
                        </div>

                        <div class="form-row pb-2">
                            <div class="form-group col-auto">
                                <label for="inputFile">*Imagem da publica&ccedil;&atilde;o:</label>
                                <input type="file" class="form-control-file mb-2" id="inputFile" name="imagem" required>

                                <img src="" id="image-preview" width="200px" class="d-none" alt="Preview">

                                <div class="invalid-feedback">
                                    Escolha a imagem da publica&ccedil;&atilde;o!
                                </div>
                            </div>

                            <div class="form-group col-auto">
                                <label for="inputDataPublicacao">Data de publica&ccedil;&atilde;o:</label>
                                <input type="text" class="form-control mask-datetime" id="inputDataPublicacao" name="publish_at" placeholder="dd/mm/aaaa hh:mm">
                            </div>
                        </div>

                        <p class="text-center"><em>* Campos de preenchimento obrigat&oacute;rio</em></p>

                        <div class="col text-center">
                            <button class="btn btn-primary" type="submit" id="btSalvar">Salvar</button>
                        </div>
                    </form>

                    <div class="progress my-3">
                        <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                    </div>

                    <div id="responseResult"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/script-control-publicacao.js') }}"></script>
@endpush

@endsection
