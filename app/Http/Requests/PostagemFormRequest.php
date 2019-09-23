<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PostagemFormRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'descricao' => 'bail|required|min:5',
            'imagem'    => 'bail|required|mimes:jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF|max:2048'
        ];
    }

    public function messages() {
        return [
            'descricao.required' => 'O campo <b class="text-uppercase">descrição</b> é de preenchimento obrigatório!',
            'descricao.min'      => 'O campo <b class="text-uppercase">descrição</b> não possui o mínimo de caracteres necessários!',
            
            'imagem.required'    => 'O campo <b class="text-uppercase">imagem</b> é de preenchimento obrigatório!',
            'imagem.image'       => 'Por favor, escolha uma <b>imagem</b> para enviar!',
            'imagem.mimes'       => 'Escolha uma imagem no formato <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b> ou <b>.gif</b>!',
            'imagem.max'         => 'Imagem escolhida é muito grande!'
        ];
    }
}
