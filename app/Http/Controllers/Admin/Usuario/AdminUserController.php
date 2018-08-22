<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $users = User::Paginate(10);
            $quantidade = count(User::all());
            return view('admin.user.home', compact('users', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '100.1');
        }
    }

    public function create()
    {
        try {
            return view('admin.user.cadastro');
        } catch (\Exception $e) {
            return abort(100, '100.2');
        }
    }

    public function store(Request $request)
    {
        try {
            $dataForm = $request->all();
            User::create([
                'name' => $dataForm['name'],
                'username' => strtolower($dataForm['username']),
                'email' => strtolower($dataForm['email']),
                'password' => bcrypt($dataForm['password']),
                'tipoUser' => 'admin',
            ]);
            return redirect()->route("admin.user");
        } catch (\Exception $e) {
            return abort(100, '100.3');
        }
    }

    public function show()
    {
        try {

        } catch (\Exception $e) {

        }
    }

    public function resetSenha($id)
    {
        try {
            $usuario = User::find($id);
            $usuario->password = bcrypt($usuario->username . '123456');
            $usuario->save();
            Session::put('mensagem', "A senha do usuário " . $usuario->name . " foi resetada com sucesso!");
            return redirect()->route("admin.user");
        } catch (\Exception $e) {
            return abort(100, '100.4');
        }
    }

    public function filtrar(Request $request)
    {
        try {
            //    $dataForm = $request->all();
            //  $alunos = $this->alunoController->filtro($dataForm);
            //$quantidade = count(Aluno::all());
            //return view('admin.aluno.home', compact('alunos', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '100.5');
        }
    }

    public function edit($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $titulo = "Editar usuário: " . $usuario->name;
            return view("admin.user.cadastro", compact('usuario', 'titulo'));
        } catch (\Exception $e) {
            return abort(100, '100.6');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dataForm = $request->all();
            $user = User::find($id);
            $user->update($dataForm);
            Session::put('mensagem', "O usuário " . $user->name . " foi editado com sucesso!");
            return redirect()->route("admin.user", compact('alunos'));
        } catch (\Exception $e) {
            return abort(100, '100.7');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete($id);

            Session::put('mensagem', "O aluno " . $user->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(100, '100.8');
        }
    }
}