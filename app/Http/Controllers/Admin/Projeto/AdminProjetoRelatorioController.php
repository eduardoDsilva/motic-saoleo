<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Projeto;

use App\Categoria;
use App\Escola;
use App\Http\Controllers\ProjetoController;
use App\Projeto;
use Illuminate\Http\Request;

class AdminProjetoRelatorioController
{

    private $projetoController;

    public function __construct(ProjetoController $projetoController)
    {
        $this->projetoController = $projetoController;
    }


    public function index()
    {
        try {
            $categorias = Categoria::all();
            $projetos = Projeto::orderBy('titulo', 'asc')
                ->where('tipo', '=', 'normal')
                ->where('ano', '=', intval(date("Y")))
                ->paginate(10);
            return view('admin.projeto.relatorios', compact('projetos', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '189.5');
        }
    }

    public function todosProjetos()
    {
        try {
            $projetos = Projeto::where('tipo', '=', 'normal')
                ->where('ano', '=', intval(date("Y")))
                ->orderBy('titulo', 'asc')
                ->get();
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
            $projetos = Projeto::where('tipo','=','normal')
                ->where('categoria_id', '=', $id)
                ->orderBy('titulo', 'asc')
                ->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.projeto.categoria-projetos', compact('projetos', 'categoria'))
                ->stream('projetos-categoria-'.$categoria->categoria.'-motic' . date('Y') . '.pdf');
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
            $projetos = $this->projetoController->filtrar($dataForm);
            $modal = true;
            $categorias = Categoria::all();
            return view('admin.projeto.relatorios', compact('projetos', 'modal', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '189.6');
        }
    }


}