<?php

namespace App\Http\Controllers\Escola\Projeto;

use App\Aluno;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjetoController;
use App\Http\Requests\Projeto\ProjetoUpdateFormRequest;
use App\Professor;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EscolaProjetoController extends Controller
{

    private $projetoController;

    public function __construct(ProjetoController $projetoController)
    {
        //No construtor da classe é carregado o controller projetoController. Lá é onde se encontra todos os códigos relacionados ao CRUD de projetos.
        $this->projetoController = $projetoController;
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é escola pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            /* os projetos que:
             *sejam de 2018
             *sejam da escola atual logada no sistema
             *sejam projetos normais
             *e retorno em ordem alfabética
            */
            $projetos = Projeto::where('ano', '=', '2018')
                ->where('tipo', '=', 'normal')
                ->where('escola_id', '=', Auth::user()->escola->id)
                ->orderBy('titulo', 'asc')
                ->paginate(10);
            //retorno para a view escola.projeto.home com os projeos
            return view('escola.projeto.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function create()
    {
        //verifico se está no período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //busco as disciplinas do sistema
            $disciplinas = Disciplina::all();
            //procuro a escola atual logada no sistema
            $escola = Escola::findOrFail(Auth::user()->escola->id);

            /* os projetos que:
             *sejam de 2018
             *sejam da escola atual logada no sistema
             *sejam projetos normais
             *e retorno em ordem alfabética
            */
            $projetos = DB::table('projetos')
                ->select('categoria_id')
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', 'normal')
                ->get();
            //iniciando um array de categoria_id
            $categoria_id = [];
            //percorrendo os projetos do sistema
            foreach ($projetos as $projeto) {
                //salvando as categorias que já estão em uso por projetos desta escola no array categoria_id
                $categoria_id[] = $projeto->categoria_id;
            }
            //buscando as categorias da escola que não estejam no array de categoria_id
            $categorias = $escola->categoria->whereNotIn('id', $categoria_id);
            //procurando os professores da escola que não estejam ligados a um projeto
            $professores = Professor::all()
                ->where('escola_id', '=', Auth::user()->escola->id)
                ->where('projeto_id', '=', null);
            //retornando para a view escola.projeto.cadastro com as informações acima
            return view("escola.projeto.cadastro", compact('disciplinas', 'escola', 'categorias', 'professores'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        //verifico se está no periodo de inscricao
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo os dados por request e insiro o escola_id artificialmente
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id];
            //passo o dataForm para o store de projetoController
            $this->projetoController->store($dataForm);
            //redireciono para a rota de escola.projeto
            return redirect()->route("escola.projeto");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }

    }

    public function show($id)
    {
        //verifico se o projeto pertence a escola logada no sistema
        $projeto = Projeto::findOrFail($id);
        $this->authorize('show', $projeto);
        try {
            //procuro os alunos que pertencam ao projeto recebido por parametro
            $alunos = Aluno::all()
                ->where('projeto_id', '=', $projeto->id);
            //procuro os professores que pertencam ao projeto recebido por parametro
            $professores = Professor::all()
                ->where('projeto_id', '=', $projeto->id);
            //retorno para a view escola.projeto.show
            return view("escola.projeto.show", compact('projeto', 'alunos', 'professores'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o projeto informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $projeto = Projeto::findOrFail($id);
        $this->authorize('edit', $projeto);
        try {
            //procurando as disciplinas do sistema
            $disciplinas = Disciplina::all();
            $titulo = 'Editar projeto: ' . $projeto->titulo;
            //retornando para a view escola.projeto.editar
            return view("escola.projeto.editar", compact('projeto', 'titulo', 'disciplinas'));

        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        //verifica se está dentro do período de inscrição
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo os dados por request
            $dataForm = $request->all();
            //passo o dataForm e o id por parametro
            $this->projetoController->update($dataForm, $id);
            //redireciono para o escola.projeto
            return redirect()->route("escola.projeto");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function filtrar(Request $request)
    {
        try {
            //recebendo os dados por request
            $dataForm = $request->all();
            //passando os dados por parametro
            $projetos = $this->projetoController->filtrar($dataForm);
            //retornando para a vire escola.projeto.home
            return view('escola.projeto.home', compact('projetos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o projeto informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $projeto = Projeto::findOrFail($id);
        $this->authorize('delete', $projeto);
        try {
            //passo o ID do projeto recebido pro ID a ser apagado para o método destroy dentro de ProjetoController.
            $this->projetoController->destroy($id);
            //por ser uma requisição em AJAX, não preciso retornar para a tela. O JQuery irá atualizar a tela.
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function alunos()
    {
        //metodo que será acessado por ajax
        try {
            //recebo o categoria_id por ajax
            $categoria_id = Input::get('categoria_id');
            //procuro os alunos que pertencam a essa escola, estejam na categoria informada e nao tenham projeto
            $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)
                ->where('categoria_id', '=', $categoria_id)
                ->where('projeto_id', '=', null)
                ->get();
            //retorno as informações por ajax em json
            return response()->json($alunos);
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}