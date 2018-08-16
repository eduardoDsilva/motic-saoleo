<?php

namespace App\Http\Controllers\Escola\Aluno;

use App\Aluno;
use App\Dado;
use App\Escola;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aluno\AlunoCreateFormRequest;
use App\Http\Requests\Aluno\AlunoUpdateFormRequest;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class EscolaAlunoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)->orderBy('name', 'asc')->paginate(10);
            $projetos = Projeto::where('escola_id', '=', Auth::user()->escola->id)->paginate(10);
            return view('escola.aluno.home', compact('alunos', 'projetos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function create()
    {
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            $ano = [];
            foreach($escola->categoria as $categoria){
                foreach($categoria->etapa as $etapa){
                    $ano[] = $etapa;
                }
            }
            return view('escola.aluno.cadastro', compact('escola', 'ano'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function store(AlunoCreateFormRequest $request)
    {
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id];
            $this->alunoController->store($dataForm);
            return redirect()->route("escola.aluno");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        $this->authorize('show', $aluno);
        try {
            return view('escola.aluno.show', compact('aluno'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $this->authorize('edit', $aluno);
        try {
            $aluno = Aluno::findOrFail($id);
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            $ano = [];
            foreach($escola->categoria as $categoria){
                foreach($categoria->etapa as $etapa){
                    $ano[] = $etapa;
                }
            }
            return view('escola.aluno.cadastro', compact('escola', 'ano', 'aluno'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function update(AlunoUpdateFormRequest $request, $id)
    {
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            $dataForm = $request->all() + ['tipoUser' => 'aluno'] + ['escola_id' => Auth::user()->escola->id];
            $alunos = $this->alunoController->update($dataForm, $id);
            return redirect()->route("escola.aluno", compact('alunos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            $alunos = $this->alunoController->filtro($dataForm);
            return view('escola.aluno.home', compact('alunos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $inscricao = \App\Inscricao::all()->last();
        $aluno = Aluno::findOrFail($id);
        $this->authorize('view', $inscricao);
        $this->authorize('delete', $aluno);
        try {
            $this->alunoController->destroy($id);
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}