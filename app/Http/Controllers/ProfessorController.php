<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Escola;
use App\Professor;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class ProfessorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function filtro($dataForm)
    {
        try {
            if ($dataForm['tipo'] == 'id') {
                $professores = Professor::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $professores = Professor::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'usuario') {
                $filtro = '%' . $dataForm['search'] . '%';
                $users = User::where('username', 'like', $filtro)->get();
                $array[] = null;
                foreach ($users as $id) {
                    $array[] = $id->id;
                }
                $professores = Professor::whereIn('user_id', $array)->paginate(10);
            } else if ($dataForm['tipo'] == 'escola') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escola = Escola::where('name', 'like', $filtro)->get();
                $array[] = null;
                foreach ($escola as $id) {
                    $array[] = $id->id;
                }
                $professores = Professor::whereIn('escola_id', $array)->paginate(10);
            } else if ($dataForm['tipo'] == 'email') {
                $professores = Professor::where('email', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nascimento') {
                $professores = Professor::where('nascimento', 'like', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'sexo') {
                $filtro = '%' . $dataForm['search'] . '%';
                $professores = Professor::where('sexo', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'cpf') {
                $professores = Professor::where('cpf', '=', $dataForm['search'])->paginate(10);
            }

            return $professores;
        } catch (\Exception $e) {
            return abort(600, '1300');
        }
    }

    public function store($dataForm)
    {
        try {
            //rodar o comando de create para criar um usuario
            $user = User::create([
                'name' => $dataForm['name'],
                'username' => strtolower($dataForm['username']),
                'email' => strtolower($dataForm['email']),
                'password' => bcrypt($dataForm['password']),
                'tipoUser' => $dataForm['tipoUser'],
            ]);
            //rodar o comando de create para criar um professor
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            Professor::create($dataForm + ['user_id' => $user->id]);
            //rodar o comando de create para criar um endereco
            Endereco::create($dataForm + ['user_id' => $user->id]);
            //insere uma mensagem de sucesso
            Session::put('mensagem', "O professor " . $user->name . " foi criado com sucesso!");

        } catch (\Exception $e) {
            return abort(600, '1310');
        }
    }


    public function update($dataForm, $id)
    {
        try {
            //busca o usuario pelo ID recebido por paremetro
            $user = User::findOrFail($id);
            //busca o professor deste usuario
            $professor = $user->professor;
            $nome = $dataForm['name'];
            unset($dataForm['name']);
            $dataForm += ['name' => ucwords(strtolower($nome))];
            //atualiza o professor com base no dataForm
            $professor->update($dataForm);
            //busca o endereco deste usuario
            $endereco = $user->endereco;
            //atualiza o professor com base no dataForm
            $endereco->update($dataForm);
            //insere uma mensagem de sucesso
            Session::put('mensagem', "O professor " . $user->name . " foi editado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1320');
        }
    }


    public function destroy($id)
    {
        try {
            //busca o professor com base no ID recebido por parametro
            $professor = Professor::findOrFail($id);
            //roda o comando delete no professor
            $professor->user()->delete($id);
            //insere uma mensagem de sucesso
            Session::put('mensagem', "O professor ".$professor->name." foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1330');
        }
    }


}
