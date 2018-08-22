<?php

namespace App\Http\Controllers\Escola\Documentos;

use App\Dado;
use App\Http\Controllers\Controller;

class EscolaDocumentosController extends Controller
{

    public function __construct()
    {
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é escola pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            //retorna pra view 'escola.documentos.documentos'
            return view('escola.documentos.documentos');
        } catch (\Exception $e) {
            return abort(200, '230');
        }
    }

}