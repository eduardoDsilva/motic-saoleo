<?php

namespace App\Http\Controllers\Escola\Aluno;

use App\Aluno;
use App\Dado;
use App\Escola;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aluno\AlunoCreateFormRequest;
use App\Http\Requests\Aluno\AlunoUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EscolaAlunoController extends Controller
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        //No construtor da classe é carregado o controller alunoController. Lá é onde se encontra todos os códigos relacionados ao CRUD de alunos.
        $this->alunoController = $alunoController;
        //Logo abaixo são carregados os middleware's responsáveis por fazer a o filtro de quem pode
        //acessar este controller. Ou seja, somente quem está autenticado e quem é escola pode acessar este controller.
        $this->middleware('auth');
        $this->middleware('check.escola');
    }

    public function index()
    {
        try {
            //busca todos os alunos pertencentes a escola logada no sistema e ordena eles em ordem alfabética.
            $alunos = Aluno::where('escola_id', '=', Auth::user()->escola->id)->orderBy('name', 'asc')->paginate(10);
            //retorna os alunos para a view de "escola.aluno.home'.
            return view('escola.aluno.home', compact('alunos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }
    }

    public function create()
    {
        //verifica se está dentro do período de inscrição e se o usuário está autorizado.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //tenta encontrar a escola no sistema a partir do ID. Se não encontrar, retorna uma exception.
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            //inicializa um array chamado ano vazio.
            $ano = [];
            //no primeiro foreach, pego as categorias da escola.
            foreach ($escola->categoria as $categoria) {
                //quando pega a primeira categoria, procuro a etapa dentro desta categoria da escola.
                foreach ($categoria->etapa as $etapa) {
                    //pega o nome da etapa e guarda dentro do array 'ano'.
                    $ano[] = $etapa;
                }
            }
            //retorna para a view escola.aluno.cadastro a collection da escola e as etapadas da escola no array 'ano'
            return view('escola.aluno.cadastro', compact('escola', 'ano'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

    public function store(AlunoCreateFormRequest $request)
    {
        //verifica se está dentro do período de inscrição e se o usuário está autorizado.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo os dados vindos da view por request. Realizo um "request->all()" para pegar os dados e adiciono o campo "escola_id" com o id da escola logada.
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id];
            //passo o $dataForm com os dados para o método "store" dentro da classe AlunoController.
            $this->alunoController->store($dataForm);
            //se tudo estiver ok, é encaminhado para a rota "escola.aluno".
            return redirect()->route("escola.aluno");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

    public function show($id)
    {
        //verifica se está dentro do período de inscrição e se o usuário está autorizado.
        $aluno = Aluno::findOrFail($id);
        $this->authorize('show', $aluno);
        try {
            //retorna para a view "escola.aluno.show" com a collection de "aluno".
            return view('escola.aluno.show', compact('aluno'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

    public function edit($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o aluno informado pela URL pertence a escola.
        $aluno = Aluno::findOrFail($id);
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        $this->authorize('edit', $aluno);
        try {
            //tenta encontrar o aluno no sistema a partir do ID recebido por parametro GET. Se não encontrar, retorna uma exception.
            $aluno = Aluno::findOrFail($id);
            //tenta encontrar a escola no sistema a partir do ID. Se não encontrar, retorna uma exception.
            $escola = Escola::findOrFail(Auth::user()->escola->id);
            //inicia um array de "ano".
            $ano = [];
            //no primeiro foreach, pego as categorias da escola.
            foreach ($escola->categoria as $categoria) {
                //quando pega a primeira categoria, procuro a etapa dentro desta categoria da escola.
                foreach ($categoria->etapa as $etapa) {
                    //pega o nome da etapa e guarda dentro do array 'ano'.
                    $ano[] = $etapa;
                }
            }
            //encaminha para a view "escola.aluno.cadastro" com a escola, ano e o aluno a ser editado.
            return view('escola.aluno.cadastro', compact('escola', 'ano', 'aluno'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

    public function update(AlunoUpdateFormRequest $request, $id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o aluno informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $this->authorize('view', $inscricao);
        try {
            //recebo os dados vindos da view por request. Realizo um "request->all()" para pegar os dados e adiciono o campo "escola_id" com o id da escola logada.
            $dataForm = $request->all() + ['escola_id' => Auth::user()->escola->id];
            //passo o $dataForm com os dados para o método "update" dentro da classe AlunoController com o ID do aluno a ser atualizado.
            $alunos = $this->alunoController->update($dataForm, $id);
            //redireciono para a rota "escola.aluno" com os alunos da escola.
            return redirect()->route("escola.aluno");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

    public function filtrar(Request $request)
    {
        try {
            //recebo as informações do filtro por request.
            $dataForm = $request->all();
            //passo as informações do filtro para o método filtro dentro de AlunoController.
            $alunos = $this->alunoController->filtro($dataForm);
            //retorno para a view "escola.aluno.home" com os alunos retornados do filtro.
            return view('escola.aluno.home', compact('alunos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        //verifica se está dentro do período de inscrição, se o usuário está autorizado e se o aluno informado pela URL pertence a escola.
        $inscricao = \App\Inscricao::all()->last();
        $aluno = Aluno::findOrFail($id);
        $this->authorize('view', $inscricao);
        $this->authorize('delete', $aluno);
        try {
            //passo o ID do aluno recebido pro ID a ser apagado para o método destroy dentro de AlunoController.
            $this->alunoController->destroy($id);
            //por ser uma requisição em AJAX, não preciso retornar para a tela. O JQuery irá atualizar a tela.
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');        }
    }

}