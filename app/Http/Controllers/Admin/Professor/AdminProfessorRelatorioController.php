<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Professor;

use App\Http\Controllers\ProfessorController;
use App\Professor;
use Illuminate\Http\Request;

class AdminProfessorRelatorioController
{

    private $professsorController;

    public function __construct(ProfessorController $professsorController)
    {
        $this->professsorController = $professsorController;
    }


    public function index()
    {
        try {
            $professores = Professor::paginate(10);
            return view('admin.professor.relatorios', compact('professores'));
        } catch (\Exception $e) {
            return abort(100, '178');
        }
    }

    public function todosProfessores()
    {
        try {
            $professores = Professor::all();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.professor.todos-professores', compact('professores'))
                ->stream('todos-professores-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '178');
        }
    }

    public function professorIndividual($id)
    {
        try {
            $professor = Professor::find($id);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.professor.professor-individual', compact('professor'))
                ->stream('professor-'.$professor->name.'-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '178');
        }
    }

    public function professoresAtivos()
    {
        try {
            $professores = Professor::orderBy('name', 'asc')->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.professor.professor-ativo', compact('professores'))
                ->stream('todos-professores-ativos-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100,  '119.3');
        }
    }

    public function filtroProfessores(Request $request)
    {
        try {
            $dataForm = $request->all();
            $professores = $this->professorController->filtrar($dataForm);
            $modal = true;
            return view('admin.suplente.relatorios', compact('professores', 'modal'));
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }
}