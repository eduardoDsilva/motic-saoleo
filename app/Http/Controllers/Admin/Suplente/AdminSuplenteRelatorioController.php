<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Suplente;

use App\Projeto;

class AdminSuplenteRelatorioController
{

    public function index()
    {
        try {
            $projetos = Projeto::where('tipo', '=', 'suplente')->paginate(10);
            return view('admin.suplente.relatorios', compact('projetos'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}