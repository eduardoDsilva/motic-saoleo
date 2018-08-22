<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Professor;

use App\Professor;
use Illuminate\Http\Request;

class AdminProfessorRelatorioController
{

    public function index()
    {
        try {
            $professores = Professor::paginate(10);
            return view('admin.professor.relatorios', compact('professores'));
        } catch (\Exception $e) {
            return abort(100, '178');
        }
    }

}