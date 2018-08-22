<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 14/05/2018
 * Time: 09:49
 */

namespace App\Http\Controllers\Professor\Projeto;

use App\Http\Controllers\Controller;
use App\Projeto;
use Illuminate\Support\Facades\Auth;

class ProfessorProjetoController extends Controller
{

    public function index()
    {
        try {
            //procuro o projeto vinculado ao professor logado no sistema
            $projeto = Projeto::all()
                ->where('id', '=', Auth::user()->professor->projeto->id);
            //encaminho para a view professor.projeto.home com o projeto encontrado
            return view('professor.projeto.home', compact('projeto'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage() . ' - Você não deveria estar aqui. Entre em contato com
            a administração da MOTIC informando este problema, preferencialmente com uma foto. Desculpem-nos o incômodo.');
        }

    }

}