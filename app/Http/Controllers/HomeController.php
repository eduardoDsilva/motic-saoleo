<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Conteudo;
use App\Projeto;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function regulamento()
    {
        return view('regulamento');
    }

    public function contato()
    {
        $conteudo = Conteudo::latest()->first();
        return view('contato', compact('conteudo'));
    }

    public function sobre()
    {
        $conteudo = Conteudo::latest()->first();
        return view('sobre', compact('conteudo'));
    }

    public function votacaoPopular()
    {
        $categorias = Categoria::all();
        return view('votacao-popular', compact('categorias'));
    }

    public function avaliacaoPopular(\Illuminate\Http\Request $request){
        $dataForm = $request->all();
        $projeto = Projeto::find($dataForm['projeto']);
        $votacao_popular = $projeto->votacao_popular + 1;
        $projeto->votacao_popular = $votacao_popular;
        $projeto->save();
        Session::put('mensagem', "O seu voto para o projeto ".$projeto->titulo." foi computado!");
        return redirect()->route('votacao-popular');
    }
}
