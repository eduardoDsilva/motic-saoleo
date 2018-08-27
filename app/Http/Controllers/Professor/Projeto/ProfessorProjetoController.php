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
            if(Auth::user()->professor->projeto==null){
                $id=0;
                $projeto = null;
            }else{
                $id = Auth::user()->professor->projeto->id;
                $projeto = Projeto::all()
                    ->where('id', '=', $id);
            }
            //encaminho para a view professor.projeto.home com o projeto encontrado
            return view('professor.projeto.home', compact('projeto'));
        } catch (\Exception $e) {
            return abort(300, '320');
        }
    }

}