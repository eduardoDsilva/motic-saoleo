<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Aluno;

use App\Aluno;
use App\Escola;
use App\Http\Controllers\AlunoController;
use Illuminate\Http\Request;

class AdminAlunoRelatorioController
{

    private $alunoController;

    public function __construct(AlunoController $alunoController)
    {
        $this->alunoController = $alunoController;
    }

    public function index()
    {
        try {
            $alunos = Aluno::orderBy('name', 'asc')->paginate();
            return view('admin.aluno.relatorios', compact('alunos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            $alunos = $this->alunoController->filtro($dataForm);
            $modal = true;
            return view('admin.aluno.relatorios', compact('alunos', 'modal'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function todosAlunosResumo()
    {
        try {
            $alunos = Aluno::orderBy('name', 'asc')->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.aluno.todos-alunos', compact('alunos'))
                ->stream('todos-alunos-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function alunosPorEscola()
    {
        try {
            $escolas = Escola::orderBy('name', 'asc')->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.aluno.escola-alunos', compact('escolas'))
                ->stream('todos-alunos-por-escola-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function alunoIndividual($id)
    {
        try {
            $aluno = Aluno::findOrFail($id);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.aluno.aluno-individual', compact('aluno'))
                ->stream('aluno-' . $aluno->name . '-' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function todosAlunosCompleto()
    {
        try {
            $alunos = Aluno::all();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.aluno.todos-alunos-completo', compact('alunos'))
                ->stream('alunos-completo-' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }
}