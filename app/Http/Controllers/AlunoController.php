<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Escola;
use App\Etapa;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        //para entrar neste Controller o usuario deve estar autenticado.
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function filtro($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $alunos = Aluno::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $alunos = Aluno::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'nascimento') {
                $alunos = Aluno::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'sexo') {
                $filtro = '%' . $dataForm['search'] . '%';
                $alunos = Aluno::where('sexo', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'etapa') {
                $filtro = '%' . $dataForm['search'] . '%';
                $alunos = Aluno::where('etapa', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)->get();
                $array[] = null;
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $alunos = Aluno::whereIn('escola_id', $array)->paginate(10);
            }
            return $alunos;
        } catch (\Exception $e) {
            return abort(1000, '1100');
        }
    }

    public function store($dataForm)
    {
        try {
            //pega o id da etapa do aluno do dataForm e busca a collection dela
            $etapa = Etapa::find($dataForm['categoria_id']);
            //salva dentro do array de dataForm o nome da etapa do aluno
            $dataForm += ['etapa' => $etapa->etapa];
            //retiro o 'categoria_id' do dataForm
            unset($dataForm['categoria_id']);
            //adiciono novamente um 'categoria_id' ao dataForm, porém, desta vez com o ID da categoria.
            $dataForm += ['categoria_id' => $etapa->categoria->id];
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            //rodo o comando Aluno::create com base no $dataForm
            $aluno = Aluno::create($dataForm);

            //insiro uma mensagem de sucesso
            Session::put('mensagem', "O aluno " . $aluno->name . " foi cadastrado com sucesso!");
        } catch (\Exception $e) {
            return abort(1000, '1110');
        }
    }

    public function update($dataForm, $id)
    {
        try {
            //pega o id da etapa do aluno do dataForm e busca a collection dela
            $etapa = Etapa::find($dataForm['categoria_id']);
            //salva dentro do array de dataForm o nome da etapa do aluno
            $dataForm += ['etapa' => $etapa->etapa];
            //retiro o 'categoria_id' do dataForm
            unset($dataForm['categoria_id']);
            //adiciono novamente um 'categoria_id' ao dataForm, porém, desta vez com o ID da categoria.
            $dataForm += ['categoria_id' => $etapa->categoria->id];
            //procuro o Aluno baseado no id recebido por parametro
            $aluno = Aluno::findOrFail($id);
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            //rodo o comando Aluno::update com base no $dataForm
            $aluno->update($dataForm);
            //insiro uma mensagem de sucesso
            Session::put('mensagem', "O aluno " . $aluno->name . " foi editado com sucesso!");

        } catch (\Exception $e) {
            return abort(1000, '1120');
        }
    }

    public function destroy($id)
    {
        try {
            //procuro o aluno baseado no id recebido por parametro
            $aluno = Aluno::findOrFail($id);
            //rodo o comando para deletar o aluno
            $aluno->delete($id);
            //insiro uma mensagem de sucesso
            Session::put('mensagem', "O aluno " . $aluno->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(1000, '1130');
        }
    }

}
