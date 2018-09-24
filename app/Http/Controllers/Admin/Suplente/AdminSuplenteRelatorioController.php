<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Suplente;

use App\Categoria;
use App\Http\Controllers\SuplenteController;
use App\Projeto;
use Illuminate\Http\Request;

class AdminSuplenteRelatorioController
{

    private $suplenteController;

    public function __construct(SuplenteController $suplenteController)
    {
        $this->suplenteController = $suplenteController;
    }

    public function index()
    {
        try {
            $categorias = Categoria::all();
            $projetos = Projeto::where('tipo', '=', 'suplente')
                ->where('ano', '=', intval(date("Y")))
                ->paginate(10);
            return view('admin.suplente.relatorios', compact('projetos', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '199.3');
        }
    }


    public function todosProjetos()
    {
        try {
            $projetos = Projeto::all()
                ->where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'suplente')
                ->orderBy('titulo', 'asc');
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.todos-projetos', compact('projetos'))
                ->stream('todos-projetos-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

    public function categoriaProjetos($id)
    {
        try {
            $categoria = Categoria::find($id);
            $projetos = Projeto::where('tipo','=','suplente')
                ->where('categoria_id', '=', $id)
                ->orderBy('titulo', 'asc')
                ->where('ano', '=', intval(date("Y")))
                ->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.categoria-projetos', compact('projetos', 'categoria'))
                ->stream('rojetos-categoria-'.$categoria->categoria.'-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }
    public function projetoIndividual($id)
    {
        try {
            $projeto = Projeto::find($id);
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.projeto-individual', compact('projeto'))
                ->stream('projeto-'.$projeto->titulo.'-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

    public function filtroProjetos(Request $request)
    {
        try {
            $dataForm = $request->all();
            $projetos = $this->suplenteController->filtrar($dataForm);
            $modal = true;
            $categorias = Categoria::all();
            return view('admin.suplente.relatorios', compact('projetos', 'modal', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }

}