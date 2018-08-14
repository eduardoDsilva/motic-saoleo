<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 14/05/2018
 * Time: 09:49
 */

namespace App\Http\Controllers\Avaliador\Projeto;

use App\Avaliador;
use App\Http\Controllers\Controller;
use App\Nota;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliadorProjetoController extends Controller
{

    public function index()
    {
        $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
        $this->authorize('view', $avaliacao);
        try {
            $avaliador = Avaliador::find(Auth::user()->avaliador->id);
            $projetos = $avaliador->projeto;
            return view('avaliador/projeto/home', compact('projetos'));
        } catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function avaliar($id)
    {
        $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
        $this->authorize('view', $avaliacao);
        $projeto = Projeto::find($id);
        $this->authorize('avaliar', $projeto);
        try {
            $projeto = Projeto::find($id);
            return view('avaliador/projeto/ficha-de-avaliacao', compact('projeto'));
        } catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function avaliacao(Request $request)
    {
        $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
        $this->authorize('view', $avaliacao);
        try {
            $dataForm = $request->all();
            $nota = new Nota;
            $notaFinal = ($dataForm['notaUm'] + $dataForm['notaDois'] + $dataForm['notaTres'] + $dataForm['notaQuatro'] + $dataForm['notaCinco'] + $dataForm['notaSeis'] + $dataForm['notaSete']);
            $nota->notaUm = $dataForm['notaUm'];
            $nota->notaDois = $dataForm['notaDois'];
            $nota->notaTres = ($dataForm['notaTres'] + $dataForm['notaQuatro']);
            $nota->notaQuatro = ($dataForm['notaCinco'] + $dataForm['notaSeis']);
            $nota->notaCinco = $dataForm['notaSete'];
            $nota->observacoes = $dataForm['observacao'];
            $nota->notaFinal = $notaFinal;
            $nota->avaliador_id = Auth::user()->avaliador->id;
            $nota->projeto_id = $dataForm['id_projeto'];
            $nota->save();
            $avaliador = Avaliador::find(Auth::user()->avaliador->id);
            $projetos = $avaliador->projeto;
            return view('avaliador/projeto/home', compact('projetos'));
        } catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

}