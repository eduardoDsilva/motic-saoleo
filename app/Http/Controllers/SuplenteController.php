<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Categoria;
use App\Escola;
use App\Professor;
use App\Projeto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SuplenteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Os suplentes seguem o mesmo padrão dos projetos normais.

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
            $escola = Escola::findOrFail($dataForm['escola_id']);
            $projeto = Projeto::all()
                ->where('escola_id', '=', $escola->id)
                ->where('tipo', '=', "suplente");
            if (count($projeto) >= $escola->projetos) {
                dd('não pode mais cadastrar suplentes');
            }
            $projeto = Projeto::create($dataForm);

            foreach ($dataForm['disciplina_id'] as $disciplina) {
                $projeto->disciplina()->attach($disciplina);
            }
            $alunos = [];
            foreach ($dataForm['aluno_id'] as $aluno_id) {
                $alunos[] = Aluno::findOrFail($aluno_id);
            }
            foreach ($alunos as $aluno) {
                $aluno->projeto_id = $projeto->id;
                $aluno->save();
            }

            $orientador = Professor::findOrFail($dataForm['orientador']);
            $orientador->projeto_id = $projeto->id;
            $orientador->tipo = 'orientador';
            $orientador->save();

            if (isset($dataForm['coorientador'])) {
                $coorientador = Professor::findOrFail($dataForm['coorientador']);
                $coorientador->projeto_id = $projeto->id;
                $coorientador->tipo = 'coorientador';
                $coorientador->save();
            }

            Session::put('mensagem', 'O projeto suplente ' . $projeto->titulo . ' foi salvo com sucesso!');


        } catch (\Exception $e) {
            return abort(600, '1500');
        }
    }

    public function filtrar($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $projetos = Projeto::where('id', '=', $dataForm['search'])
                                ->where('tipo', '=', 'normal')
                                ->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $projetos = Projeto::where('titulo', 'like', $filtro)
                                ->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)
                                ->where('tipo', '=', 'normal')
                                ->get();
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $projetos = Projeto::whereIn('escola_id', $array)
                                ->where('tipo', '=', 'normal')
                                ->paginate(10);
            } else if ($dataForm['tipo'] == 'categoria') {
                $categoria = Categoria::where('categoria', '=', $dataForm['search'])
                                ->get();
                $array[] = null;
                foreach ($categoria as $id) {
                    $array[] = $id->id;
                }
                $projetos = Projeto::whereIn('categoria_id', $array)
                    ->where('tipo', '=', 'normal')
                    ->paginate(10);
            }
            return $projetos;
        } catch (\Exception $e) {
            return abort(600, '1510');
        }
    }

    public function update($dataForm, $id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->update($dataForm);
            $projeto->disciplina()->detach();
            foreach ($dataForm['disciplina_id'] as $disciplina) {
                $projeto->disciplina()->attach($disciplina);
            }

            Session::put('mensagem', "O projeto suplente " . $projeto->titulo . " foi editado com sucesso!");

        } catch (\Exception $e) {
            return abort(600, '1520');
        }
    }

    public function destroy($id)
    {
        try {
            DB::update('update alunos set projeto_id = ? where projeto_id = ?', [null, $id]);
            DB::update('update professores set projeto_id = ? where projeto_id = ?', [null, $id]);
            $projeto = Projeto::findOrFail($id);
            $projeto->delete($id);
            Session::put('mensagem', "O projeto suplente " . $projeto->titulo . " foi deletado com sucesso!");

        } catch (\Exception $e) {
            return abort(600, '1530');
        }
    }

}
