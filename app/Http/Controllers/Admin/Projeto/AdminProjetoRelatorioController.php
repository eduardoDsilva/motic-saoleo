<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Projeto;

use App\Projeto;

class AdminProjetoRelatorioController
{

    public function index()
    {
        try {
            $projetos = Projeto::where('tipo', '=', 'normal')->paginate(10);
            return view('admin.projeto.relatorios', compact('projetos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}