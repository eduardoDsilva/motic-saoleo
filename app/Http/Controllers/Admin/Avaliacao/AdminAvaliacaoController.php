<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Dado;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;

class AdminAvaliacaoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

}