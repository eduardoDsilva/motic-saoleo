<?php

namespace App\Http\Controllers\Admin\Avaliacao;

use App\Categoria;
use App\Dado;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;
use App\Nota;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAvaliacaoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function calcularNotas()
    {
        $projetos = Projeto::all()->where('tipo', '=', 'normal');
        foreach ($projetos as $projeto) {
            $notaFinal = 0;
            $notas = Nota::all()->where('projeto_id', '=', $projeto->id);
            foreach ($notas as $nota) {
                $notaFinal += $nota->notaFinal;
            }
            if (count($notas) == 3) {
                $projeto->notafinal = $notaFinal;
                $projeto->avaliado = 'sim';
                $projeto->save();
            }
        }
        Session::put('mensagem', "As notas foram calculadas!");
        return redirect()->route('admin.avaliacao.classificacao');
    }

    public function projetosAvaliados()
    {
        $n = Nota::all();
        $notas = [];
        foreach ($n as $nota) {
            $notas[] = intval($nota->projeto_id);
        }
        $count = 0;
        foreach ($notas as $n) {
            foreach ($notas as $nota) {
                if ($nota == $n) {
                    $count++;
                }
            }
            if ($count < 3) {
                $key = array_keys($notas, $n);
                foreach ($key as $k) {
                    unset($notas[$k]);
                }
            }
            $count = 0;
        }
        $projetos = Projeto::where('tipo', '=', 'normal')
            ->whereIn('id', array_unique($notas))
            ->orderBy('titulo', 'asc')
            ->get();
        $quantidade = count($projetos);
        return view('admin.avaliacao.projetos-avaliados', compact('projetos', 'quantidade'));
    }

    public function projetosNaoAvaliados()
    {
        $n = Nota::all();
        $notas = [];
        foreach ($n as $nota) {
            $notas[] = intval($nota->projeto_id);
        }
        $count = 0;
        foreach ($notas as $n) {
            foreach ($notas as $nota) {
                if ($nota == $n) {
                    $count++;
                }
            }
            if ($count < 3) {
                $key = array_keys($notas, $n);
                foreach ($key as $k) {
                    unset($notas[$k]);
                }
            }
            $count = 0;
        }
        $projetos = Projeto::where('tipo', '=', 'normal')
            ->whereNotIn('id', array_unique($notas))
            ->orderBy('titulo', 'asc')
            ->get();
        $quantidade = count($projetos);
        return view('admin.avaliacao.projetos-nao-avaliados', compact('projetos', 'quantidade'));
    }

    public function classificacao()
    {
        $categorias = Categoria::all();
        return view('admin.avaliacao.classificacao', compact('categorias', 'projetos'));
    }

    public function retornaClassificacao(Request $request)
    {
        $dataForm = $request->all();
        $projetos = Projeto::orderBy('notafinal', 'desc')
            ->where('avaliado', '=', 'sim')
            ->where('tipo', '=', 'normal')
            ->where('categoria_id', '=', $dataForm['categoria_id'])
            ->orderBy('titulo', 'asc')->get();
        $categoria = Categoria::find($dataForm['categoria_id']);
        return view('admin.avaliacao.classificacao', compact('categoria' , 'projetos'));
    }

    public function classificacaoPopular(){
        $projetos = Projeto::where('tipo', '=', 'normal')
                            ->orderBy('votacao_popular', 'desc')
                            ->get();
        return view('admin.avaliacao.classificacao-popular', compact('projetos'));
    }

}