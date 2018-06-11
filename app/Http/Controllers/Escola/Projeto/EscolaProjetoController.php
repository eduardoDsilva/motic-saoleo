<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 14/05/2018
 * Time: 09:49
 */

namespace App\Http\Controllers\Escola\Projeto;

use App\Aluno;
use App\Disciplina;
use App\Escola;
use App\Http\Controllers\Auditoria\AuditoriaController;
use App\Http\Controllers\Controller;
use App\Professor;
use App\Projeto;
use App\Suplente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class EscolaProjetoController extends Controller
{

    private $auditoriaController;
    private $professor;
    private $escola;

    public function index()
    {
        $projetos = Projeto::where('ano', '=', '2018')->where('escola_id', '=', Auth::user()->escola->id)->paginate(10);
        $suplentes = Suplente::where('ano', '=', '2018')->where('escola_id', '=', Auth::user()->escola->id)->paginate(10);

        return view('escola/projeto/home', compact('projetos', 'suplentes'));
    }

    public function __construct(AuditoriaController $auditoriaController, Professor $professor, Escola $escola)
    {
        $this->auditoriaController = $auditoriaController;
        $this->escola = $escola;
        $this->professor = $professor;
    }

    public function create(){
        $disciplinas = Disciplina::all();
        $escola = Escola::find(Auth::user()->escola->id);

        $projetos = DB::table('projetos')->select('categoria_id')->where('escola_id', '=', $escola->id)->get();
        $categoria_id = [];
        foreach($projetos as $projeto){
            $categoria_id[] = $projeto->categoria_id;
        }
        $categorias = $escola->categoria->whereNotIn('id', $categoria_id);

        return view("escola/projeto/cadastro/registro", compact('disciplinas', 'escola', 'categorias'));
    }

    public function store(Request $request){
        $dataForm = $request->all();
        try{
            if($dataForm['tipoProjeto'] == 'suplente') {
                $escola = Escola::find($dataForm['escola_id']);
                $suplente = Suplente::all()->where('escola_id', '=', $escola->id);
                if(count($suplente)>=$escola->projetos){
                    dd('não pode mais cadastrar projetos');
                }
                $suplente = Suplente::create($dataForm);

                foreach ($request->only(['disciplina_id']) as $disciplina) {
                    $suplente->disciplina()->attach($disciplina);
                }

                foreach ($request->only(['aluno_id']) as $aluno_id) {
                    $alunos = Aluno::find($aluno_id);
                }

                foreach ($alunos as $aluno) {
                    $aluno->suplente_id = $suplente->id;
                    $aluno->save();
                }

                $orientador = Professor::find($dataForm['orientador']);
                $orientador->suplente_id = $suplente->id;
                $orientador->tipo = 'orientador';
                $orientador->save();

                if (isset($dataForm['coorientador'])) {
                    $coorientador = Professor::find($dataForm['coorientador']);
                    $coorientador->suplente_id = $suplente->id;
                    $coorientador->tipo = 'coorientador';
                    $coorientador->save();
                }

            }else{
                $escola = Escola::find($dataForm['escola_id']);
                $projeto = Projeto::all()->where('escola_id', '=', $escola->id);
                if(count($projeto)>=$escola->projetos){
                    dd('não pode mais cadastrar projetos');
                }
                $projeto = Projeto::create($dataForm);

                foreach ($request->only(['disciplina_id']) as $disciplina) {
                    $projeto->disciplina()->attach($disciplina);
                }

                foreach ($request->only(['aluno_id']) as $aluno_id) {
                    $alunos = Aluno::find($aluno_id);
                }

                foreach ($alunos as $aluno) {
                    $aluno->projeto_id = $projeto->id;
                    $aluno->save();
                }

                $orientador = Professor::find($dataForm['orientador']);
                $orientador->projeto_id = $projeto->id;
                $orientador->tipo = 'orientador';
                $orientador->save();

                if (isset($dataForm['coorientador'])) {
                    $coorientador = Professor::find($dataForm['coorientador']);
                    $coorientador->projeto_id = $projeto->id;
                    $coorientador->tipo = 'coorientador';
                    $coorientador->save();
                }
            }
            $projetos = Projeto::where('ano', '=', '2018')->paginate(10);
            $suplentes = Suplente::where('ano', '=', '2018')->paginate(10);

            return view('escola/projeto/home', compact('projetos', 'suplentes'));
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }

    }

    public function show($id){
        try{
            $projeto = Projeto::find($id);
            $alunos = Aluno::all()->where('projeto_id', '=', $projeto->id);
            $professores = Professor::all()->where('projeto_id', '=', $projeto->id);
            return view("escola/projeto/show", compact('projeto', 'alunos', 'professores'));
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function edit($id){
        try{
            $projeto = Projeto::find($id);
            $disciplinas = Disciplina::all();
            $titulo = 'Editar projeto: '.$projeto->titulo;
            return view("escola/projeto/edita/editar", compact( 'projeto', 'titulo', 'disciplinas'));
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function update(Request $request, $id){
        $dataForm = $request->all();
        try{
            $projeto = Projeto::find($id);
            $projeto->update($dataForm);
            $projeto->disciplina()->detach();
            foreach ($request->only(['disciplina_id']) as $disciplina){
                $projeto->disciplina()->attach($disciplina);
            }
            $this->auditoriaController->storeUpdate(json_encode($projeto, JSON_UNESCAPED_UNICODE), $projeto->id);

            Session::put('mensagem', "O projeto ".$projeto->titulo." foi editado com sucesso!");

            return redirect()->route("escola/projeto/home");
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function destroy($id){
        try{
            DB::update('update alunos set projeto_id = ? where projeto_id = ?',[null,$id]);
            DB::update('update professores set projeto_id = ? where projeto_id = ?',[null,$id]);
            $projeto = Projeto::find($id);
            $projeto->delete($id);
            $this->auditoriaController->storeDelete(json_encode($projeto, JSON_UNESCAPED_UNICODE), $projeto->id);
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function categorias(){
        $escola_id = Input::get('escola_id');
        Session::put('escola_id', $escola_id);
        $escola = $this->escola->find($escola_id);
        $projetos = DB::table('projetos')->select('categoria_id')->where('escola_id', '=', $escola->id)->get();
        $categoria_id = [];
        foreach($projetos as $projeto){
            $categoria_id[] = $projeto->categoria_id;
        }
        $categoria = $escola->categoria->whereNotIn('id', $categoria_id);

        return response()->json($categoria);
    }

    public function alunos(){
        $categoria_id = Input::get('categoria_id');
        $alunos = Aluno::where('escola_id', '=', Session::get('escola_id'))->where('categoria_id', '=', $categoria_id)->where('projeto_id', '=', null)->get();
        return response()->json($alunos);
    }

    public function professores(){
        $escola_id = Input::get('escola_id');
        $professores = Professor::where('escola_id', '=', $escola_id)->where('projeto_id', '=', null)->get();
        return response()->json($professores);
    }

}