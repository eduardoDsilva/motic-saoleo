<?php

namespace App\Http\Controllers\Escola\Professor;

use App\Dado;
use App\Escola;
use App\Http\Controllers\ProfessorController;
use App\Http\Requests\Professor\ProfessorCreateFormRequest;
use App\Http\Requests\Professor\ProfessorUpdateFormRequest;
use App\Professor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscolaProfessorController extends Controller
{

    private $professorController;

    public function __construct(ProfessorController $professorController)
    {
        //No construtor da classe é carregado o controller ProfessorController. Lá é onde se encontra todos os códigos relacionados ao CRUD de professores.
        $this->professorController = $professorController;
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é escola pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            //busco todos os professores que pertencem a escola logada no sistema
            $professores = Professor::where('escola_id', '=', Auth::user()->escola->id)->orderBy('name', 'asc')->paginate(10);
            //retorno para a view escola.professor.home com os professores
            return view("escola.professor.home", compact('professores'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');         }
    }

    public function create()
    {
        //verifico se está no período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //procuro a escola logada no sistema
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            //retorno para a view escola.professor.cadastro com a escola logada
            return view('escola.professor.cadastro', compact('escola'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');         }
    }

    public function store(ProfessorCreateFormRequest $request)
    {
        //verifico se está no período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo por request os dados do professor e adiciono artificialmente o campo 'escola_id' com o id da escola logada no sistema.
            $dataForm = $request->all() + ['tipoUser' => 'professor'] + ['escola_id' => Auth::user()->escola->id];
            //passo os dados para o metodo store de professorController
            $this->professorController->store($dataForm);
            //redireciono para a rota escola.professor
            return redirect()->route("escola.professor");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');         }
    }

    public function show($id)
    {
        //verifico se o professor do ID pertence a essa escola
        $professor = Professor::findOrFail($id);
        $this->authorize('show', $professor);
        try {
            //retorno para a view escola.professor.show com o professor recebido por paremetro
            return view("escola.professor.show", compact('professor'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

    public function edit($id)
    {
        //verifico se está no período de inscrição e se o professor do ID pertence a essa escola
        $inscricao = \App\Inscricao::all()->last();
        $professor = Professor::findOrFail($id);
        $this->authorize('view', $inscricao);
        $this->authorize('edit', $professor);
        try {
            //encontro a escola atual logada no sistema
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            $titulo = 'Editar professor: ' . $professor->name;
            //retorno para a view escola.professor.cadastro com as seguintes informações
            return view("escola.professor.cadastro", compact('professor', 'titulo', 'escola'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            //recebo os dados por request
            $dataForm = $request->all();
            //passo os dados para o metodo de filtrar professores
            $professores = $this->professorController->filtro($dataForm);
            //retorno o resultado o filtro para a view escola.professor.home
            return view('escola.professor.home', compact('professores'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

    public function update(ProfessorUpdateFormRequest $request, $id)
    {
        //verifico se está no período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $professor = Professor::findOrFail($id);
        $this->authorize('view', $professor);
        $this->authorize('view', $inscricao);
        try {
            //recebo por request os dados do professor e adiciono artificialmente o campo 'escola_id' com o id da escola logada no sistema.
            $dataForm = $request->all() + ['tipoUser' => 'professor'] + ['escola_id' => Auth::user()->escola->id];
            //passo os dados para o metodo store de professorController
            $this->professorController->update($dataForm, $id);
            //redireciono para a rota escola.professor
            return redirect()->route("escola.professor");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

    public function destroy($id)
    {
        //verifico se está no período de inscrição e se o professor do ID pertence a essa escola
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $professor = Professor::findOrFail($id);
        $this->authorize('delete', $professor);
        try {
            //chamo o metodo de destroy professor.
            $this->professorController->destroy($id);
            //nao passo nenhuma rota ou view pois o metodo de destroy é por meio de AJAX, logo a pagina é atualizada dinamicamente pelo JS
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

}