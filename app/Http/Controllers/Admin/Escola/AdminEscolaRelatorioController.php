<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Escola;

use App\Escola;

class AdminEscolaRelatorioController
{

    public function index()
    {
        try {
            $escolas = Escola::all();
            return view('admin.escola.relatorios', compact('escolas'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }


    public function todasEscolas()
    {
        try {
            $escolas = Escola::orderBy('name', 'asc')->get();
            return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
                ->loadView('pdf.escola.todas-escolas', compact('escolas'))
                ->stream('todas-escolas-motic' . date('Y') . '.pdf');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}