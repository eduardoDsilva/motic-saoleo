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
            return abort(403, '' . $e->getMessage());

        }
    }

    public function store($dataForm)
    {
        try {
            $etapa = Etapa::find($dataForm['categoria_id']);
            $dataForm += ['etapa' => $etapa->etapa];
            unset($dataForm['categoria_id']);
            $dataForm += ['categoria_id' => $etapa->categoria->id];
            $aluno = Aluno::create($dataForm);

            Session::put('mensagem', "O aluno " . $aluno->name . " foi cadastrado com sucesso!");

        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());

        }
    }

    public function update($dataForm, $id)
    {
        try {
            $etapa = Etapa::find($dataForm['categoria_id']);
            $dataForm += ['etapa' => $etapa->etapa];
            unset($dataForm['categoria_id']);
            $dataForm += ['categoria_id' => $etapa->categoria->id];

            $aluno = Aluno::findOrFail($id);
            $aluno->update($dataForm);

            Session::put('mensagem', "O aluno " . $aluno->name . " foi editado com sucesso!");

            return Aluno::paginate(10);
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());

        }
    }

    public function destroy($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            $aluno->delete($id);

            Session::put('mensagem', "O aluno " . $aluno->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());

        }
    }

}
