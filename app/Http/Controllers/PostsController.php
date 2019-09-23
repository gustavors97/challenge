<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Http\Requests\PostagemFormRequest;

class PostsController extends Controller {

    private $postagem;

    public function __construct(Postagem $postagem) {
        $this->middleware('auth');
        $this->postagem = $postagem;
    }

    public function novo() {
        return view('novo');
    }

    /**
     * Cria um novo registro no banco de dados
     */
    public function create(PostagemFormRequest $request) {
        $data = $request->all();

        $data['ativa']    = $data['publish_at'] == null ? 'N' : 'S';
        $data['user_inc'] = Auth::id();
        $data['user_alt'] = Auth::id();

        $publishAt = str_replace("/", "-", $data['publish_at'] . ':00');
        
        if ($publishAt <> null) {
            $data['publish_at'] = date('Y-m-d H:i:s', strtotime($publishAt));
        }

        $image = $request->file('imagem');

        $image_name = 'post_' . time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('\\img\\posts\\'), $image_name);

        $data['imagem'] = $image_name;      // Obtém o novo nome da imagem

        $result = $this->postagem->create($data);

        if ($result)
            return response()->json(array('status' => 'success', 'message' => 'Registro inserido com sucesso!'));
        else
            return response()->json(array('status' => 'fail', 'message' => 'Falha ao tentar inserir o registro!'));
    }
}
