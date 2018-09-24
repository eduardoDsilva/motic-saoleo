<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Avaliador;

use App\Avaliador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAvaliadorRelatorioController extends Controller
{

    public function index()
    {
        try {
            $avaliadores = Avaliador::orderBy('name', 'asc')->paginate(10);
            return view('admin.avaliador.relatorios', compact('avaliadores'));
        } catch (\Exception $e) {
            return abort(100, '129');
        }
    }

    public function avaliadorProjetos()
    {
        $avaliadores = Avaliador::orderBy('name', 'asc')->get();
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.avaliador.avaliador-projetos', compact('avaliadores'))
            ->stream('avaliadores-projetos-motic' . date('Y') . '.pdf');
    }

    public function todosAvaliadores()
    {
        $avaliadores = Avaliador::orderBy('name', 'asc')->get();
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.avaliador.todos-avaliadores', compact('avaliadores'))
            ->stream('todos-avaliadores-motic' . date('Y') . '.pdf');
    }

    public function avaliadorIndividual($id)
    {
        $avaliador = Avaliador::findOrFail($id);
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.avaliador.avaliador-individual', compact('avaliador'))
            ->stream('avaliador-' . $avaliador->name . '-' . date('Y') . '.pdf');
    }

    public function avaliadorIndividualProjetos($id)
    {
        $avaliador = Avaliador::findOrFail($id);
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.avaliador.avaliador-individual-projetos', compact('avaliador'))
            ->stream('avaliador-' . $avaliador->name . '-' . date('Y') . '.pdf');
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            $modal2 = true;
            if ($dataForm['tipo'] == 'id') {
                $avaliadores = Avaliador::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $avaliadores = Avaliador::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'sexo') {
                $filtro = '%' . $dataForm['search'] . '%';
                $avaliadores = Avaliador::where('sexo', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'cpf') {
                $avaliadores = Avaliador::where('username', '=', $dataForm['search'])->paginate(10);
            }
            return view('admin.avaliador.relatorios', compact('avaliadores', 'modal2'));
        } catch (\Exception $e) {
            return abort(100, '129.1');
        }
    }
}