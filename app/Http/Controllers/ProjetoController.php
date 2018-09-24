<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Categoria;
use App\Escola;
use App\Professor;
use App\Projeto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjetoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function store($dataForm)
    {
        try {
            //procuro a escola baseado no ID do dataForm
            $escola = Escola::findOrFail($dataForm['escola_id']);
            //procuro todos os projetos da escola
            $projeto = Projeto::all()
                ->where('ano', '=', intval(date("Y")))
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', "normal");
            //se a escola tiver uma quantidade de projetos maior ou igual a quantidade delimitada no banco de dados, retorna um erro
            if (count($projeto) >= $escola->projetos) {
                dd('não pode mais cadastrar projetos');
                //detalhe: o sistema não deve permitir que seja possivel chegar até aqui. Esta é uma ultima linha de defesa.
            }
            //crio o projeto com base no dataForm
            $projeto = Projeto::create($dataForm);
            //recebo as disciplinas pelo dataForm e rodo em um foreach
            foreach ($dataForm['disciplina_id'] as $disciplina) {
                //anexo as disciplinas ao projeto
                $projeto->disciplina()->attach($disciplina);
            }
            //inicio um array de alunos
            $alunos = [];
            //procuro os alunos vindos do dataForm
            foreach ($dataForm['aluno_id'] as $aluno_id) {
                //procuro os alunos pelo id e adiciono dentro do array de alunos[]
                $alunos[] = Aluno::findOrFail($aluno_id);
            }
            //percorro o array de alunos
            foreach ($alunos as $aluno) {
                //adiciono ao projeto_id o id do projeto
                $aluno->projeto_id = $projeto->id;
                //salvo e vinculo
                $aluno->save();
            }
            //procuro o professor pelos dados vindos do dataForm
            $orientador = Professor::findOrFail($dataForm['orientador']);
            //passo o id do projeto pra dentro do projeto_id
            $orientador->projeto_id = $projeto->id;
            //defino o tipo do professor, que nesse caso é orientador
            $orientador->tipo = 'orientador';
            //salvo
            $orientador->save();
            //caso exista um coorientador
            if (isset($dataForm['coorientador'])) {
                //procuro o professor pelos dados vindos do dataForm
                $coorientador = Professor::findOrFail($dataForm['coorientador']);
                //passo o id do projeto pra dentro do projeto_id
                $coorientador->projeto_id = $projeto->id;
                //defino o tipo do professor, que nesse caso é coorientador
                $coorientador->tipo = 'coorientador';
                //salvo
                $coorientador->save();
            }
            //defino uam mensagem de sucesso
            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi salvo com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1400');
        }
    }

    public function filtrar($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $projetos = Projeto::where('id', '=', $dataForm['search'])
                    ->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $projetos = Projeto::where('titulo', 'like', $filtro)
                    ->where('ano', '=', intval(date("Y")))
                    ->where('tipo', '=', 'normal')
                    ->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)
                    ->get();
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $projetos = Projeto::whereIn('escola_id', $array)
                    ->where('tipo', '=', 'normal')
                    ->where('ano', '=', intval(date("Y")))
                    ->paginate(10);
            } else if ($dataForm['tipo'] == 'categoria') {
                $categoria = Categoria::where('categoria', '=', $dataForm['search'])->get();
                $array[] = null;
                foreach ($categoria as $id) {
                    $array[] = $id->id;
                }
                $projetos = Projeto::whereIn('categoria_id', $array)
                    ->where('tipo', '=', 'normal')
                    ->where('ano', '=', intval(date("Y")))
                    ->paginate(10);
            }
            return $projetos;
        } catch (\Exception $e) {
            return abort(600, '1410');
        }
    }

    public function update($dataForm, $id)
    {
        try {
            //procuro o projeto baseado no ID recebido por parametro
            $projeto = Projeto::findOrFail($id);
            //rodo o comando de update no projeto baseado no dataForm
            $projeto->update($dataForm);
            //desanexo todas as disciplinas do trabalho
            $projeto->disciplina()->detach();
            //pego as disciplinas recebidas pelo dataForm e varro elas com o foreach
            foreach ($dataForm['disciplina_id'] as $disciplina) {
                //anexo as disciplinas do dataForm ao projeto.
                $projeto->disciplina()->attach($disciplina);
            }
            //insiro uma mensagem de sucesso
            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi editado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1420');
        }
    }

    public function destroy($id)
    {
        try {
            //as linhas abaixo são as responsaveis por RETIRAR o campo "projeto_id"  dos alunos e professores. Ou seja, por desvincular o projeto dos professores e alunos
            DB::update('update alunos set projeto_id = ? where projeto_id = ?', [null, $id]);
            DB::update('update professores set projeto_id = ? where projeto_id = ?', [null, $id]);
            //procura o projeto pelo ID recebido por parametro
            $projeto = Projeto::findOrFail($id);
            //roda o comando de deletar o projeto
            $projeto->delete($id);
            //insere uma mensagem de sucesso
            Session::put('mensagem', "O projeto " . $projeto->titulo . " foi deletado com sucesso!");

        } catch (\Exception $e) {
            return abort(600, '1430');
        }
    }

}