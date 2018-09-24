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
        $this->periodoAvaliacao();
        try {
            $avaliador = Avaliador::find(Auth::user()->avaliador->id);
            $projetos = $avaliador->projeto;
            return view('avaliador/projeto/home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(400, '420');
        }
    }

    public function avaliar($id)
    {
        $this->periodoAvaliacao();
        $projeto = Projeto::find($id);
        $this->authorize('avaliar', $projeto);
        try {
            $projeto = Projeto::find($id);
            return view('avaliador/projeto/ficha-de-avaliacao', compact('projeto'));
        } catch (\Exception $e) {
            return abort(400, '421');
        }
    }

    public function avaliacao(Request $request)
    {
        $this->periodoAvaliacao();
        try {
            $dataForm = $request->all();
            $this->salvaNota($dataForm);
            return redirect()->route('avaliador.projeto');
        } catch (\Exception $e) {
            return abort(400, '422');
        }
    }

    public function editarAvaliacao($id)
    {
        $this->periodoAvaliacao();
        try {
            $projeto = Projeto::find($id);
            $nota = Nota::where('projeto_id', '=', $id)->where('avaliador_id', '=', Auth::user()->avaliador->id)->first();
            return view('avaliador.projeto.editar-avaliacao', compact('nota', 'projeto'));
        } catch (\Exception $e) {
            return abort(400, '423');
        }
    }

    public function editaAvaliacao(Request $request)
    {
        $this->periodoAvaliacao();
        try {
            $dataForm = $request->all();
            $nota = Nota::where("avaliador_id", '=', Auth::user()->avaliador->id)
                ->where("projeto_id", '=', $dataForm['id_projeto'])->first();
            $this->salvaNota($dataForm, $nota);
            return redirect()->route('avaliador.projeto');
        } catch (\Exception $e) {
            return abort(400, '424');
        }
    }

    private function salvaNota($dataForm){
        $nota = new Nota;
        $notaFinal = ($dataForm['notaUm'] + $dataForm['notaDois'] + ($dataForm['notaTres'] + $dataForm['notaQuatro']) + $dataForm['notaCinco'] + $dataForm['notaSeis'] + $dataForm['notaSete']);
        $nota->notaUm = intval($dataForm['notaUm']);
        $nota->notaDois = intval($dataForm['notaDois']);
        $nota->notaTres = intval($dataForm['notaTres']);
        $nota->notaQuatro = intval($dataForm['notaQuatro']);
        $nota->notaCinco = intval($dataForm['notaCinco']);
        $nota->notaSeis = intval($dataForm['notaSeis']);
        $nota->notaSete = intval($dataForm['notaSete']);
        $nota->notaFinal = intval($notaFinal);
        $nota->observacoes = $dataForm['observacao'];
        $nota->avaliador_id = Auth::user()->avaliador->id;
        $nota->projeto_id = $dataForm['id_projeto'];
        $nota->save();
    }

    private function periodoAvaliacao(){
        $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
        $this->authorize('view', $avaliacao);
    }


}