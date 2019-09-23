<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Postagem;

class HomeController extends Controller {

    private $postagem;

    public function __construct(Postagem $postagem) {
        $this->middleware('auth');
        $this->postagem = $postagem;
    }

    public function index() {
        $postagens = $this->postagem->orderBy('created_at')->paginate(20);
        return view('home', compact('postagens'));
    }

    /**
     * Troca o status para publicado (ativa = S)
     */
    public function publish(Request $request) {
        $result = $this->postagem->where('id', '=', $request->id)
                                ->update(['ativa' => 'S', 'user_alt' => Auth::id(), 'publish_at' => Carbon::now()]);

        if ($result)
            return response()->json(array('status' => 'success', 'message' => 'Registro atualizado com sucesso!'));
        else
            return response()->json(array('status' => 'fail', 'message' => 'Falha ao tentar atualizar o registro!'));
    } 

    /**
     * Remove uma publicação
     */
    public function remove(Request $request) {
        $postagem = $this->postagem->find($request->id);
        $result = $postagem->delete();

        if ($result)
            return response()->json(array('status' => 'success', 'message' => 'Registro removido com sucesso!'));
        else
            return response()->json(array('status' => 'fail', 'message' => 'Falha ao tentar remover o registro!'));
    }
}
