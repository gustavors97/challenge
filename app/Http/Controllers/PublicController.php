<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Postagem;
use Illuminate\Http\Request;

class PublicController extends Controller {

    public function __construct(Postagem $postagem) {
        $this->postagem = $postagem;
    }

    public function index() {
        $postagens = $this->postagem->orderBy('publish_at')
                        ->select('id', 'titulo', 'imagem', 'descricao')
                        ->where('ativa', '=', 'S')
                        ->where('publish_at', '<=', Carbon::now())
                        ->paginate(20);

        return view('public', compact('postagens'));
    }

    public function postagem($id) {
        $postagem = $this->postagem->select('titulo', 'imagem', 'descricao', 'publish_at', 'users.name')
                        ->join('users', 'postagem.user_alt', '=', 'users.id')
                        ->find($id);

        $publishAt = $postagem['publish_at'];
        if ($publishAt <> null) {
            $postagem['publish_at'] = date('d/m/Y H:i', strtotime($publishAt));
        }

        return view('public_post', compact('postagem'));
    }
}
