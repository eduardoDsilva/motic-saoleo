<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Escola;
use App\User;
use Illuminate\Support\Facades\Session;

class EscolaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        //para entrar neste Controller o usuario deve estar autenticado e ser um administrador.
        $this->middleware('auth');
        $this->middleware('auth.admin');
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
                $escolas = Escola::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escolas = Escola::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'usuario') {
                $filtro = $dataForm['search'];
                $escolas = [User::where('username', '=', $filtro)->first()->escola];
            } else if ($dataForm['tipo'] == 'email') {
                $filtro = '%' . $dataForm['search'] . '%';
                $escolas = Escola::where('email', 'like', $filtro)->paginate(10);
            }
            return $escolas;
        } catch (\Exception $e) {
            return abort(600, '1200');
        }
    }

    public function store($dataForm)
    {
        try {
            //pego a quantidade de categorias que a escola tem.
            //como a qnt de projetos esta ligada a qnt de categorias, eu utilizo a mesma medida.
            $qntProjetos = $dataForm['categoria_id'];
            //crio um usuario pra escola
            $user = User::create([
                'name' => $dataForm['name'],
                'username' => strtolower($dataForm['username']),
                'email' => strtolower($dataForm['email']),
                'password' => bcrypt($dataForm['password']),
                'tipoUser' => $dataForm['tipoUser'],
            ]);
            //crio a escola.
            $escola = Escola::create($dataForm + ['user_id' => $user->id] + ['projetos' => count($qntProjetos)]);
            //varrendo as categorias da escola
            foreach ($dataForm['categoria_id'] as $categoria) {
                //anexando as categorias a esta escola.
                $escola->categoria()->attach($categoria);
            }
            //criando o endereço da escola
            $endereco = Endereco::create($dataForm + ['user_id' => $user->id]);
            //mensagem de sucesso
            Session::put('mensagem', "A escola " . $escola->name . " foi cadastrada com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1210');
        }
    }

    public function update($dataForm, $id)
    {
        try {
            $qntProjetos = $dataForm['categoria_id'];
            //pego o usuario da escola recebido por parametro
            $user = User::findOrFail($id);

            //pego a escola do usuario
            $escola = $user->escola;
            //rodo o comando de update na escola com a quantidade de projetos que a escola pode ter
            $escola->update($dataForm + ['projetos' => count($qntProjetos)]);
            //desanexo todas categorias da escola
            $escola->categoria()->detach();
            //rodo um foreach nas categorias recebidas por dataForm
            foreach ($dataForm['categoria_id'] as $categoria) {
                //anexo a categoria a escola
                $escola->categoria()->attach($categoria);
            }
            //pego o endereco da escola
            $endereco = $user->endereco;
            //rodo o camando de update no endereco
            $endereco->update($dataForm);
            //insiro uma mensagem de sucesso
            Session::put('mensagem', "A escola " . $escola->name . " foi editada com sucesso!");

        } catch (\Exception $e) {
            return abort(600, '1220');
        }
    }

    public function destroy($id)
    {
        try {
            //procuro a escola baseado no id recebido por parametro
            $escola = Escola::findOrFail($id);
            //rodo o comando para deletar a escola
            $escola->user()->delete($id);
            //insiro uma mensagem de sucesso
            Session::put('mensagem', "A escola " . $escola->name . " foi deletada com sucesso!");
        } catch (\Exception $e) {
            return abort(600, '1230');
        }
    }

}
