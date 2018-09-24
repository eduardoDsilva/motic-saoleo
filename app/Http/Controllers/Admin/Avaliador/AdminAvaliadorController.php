<?php

namespace App\Http\Controllers\Admin\Avaliador;

use App\Avaliador;
use App\Categoria;
use App\Dado;
use App\Endereco;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Avaliador\AvaliadorCreateFormRequest;
use App\Http\Requests\Admin\Avaliador\AvaliadorUpdateFormRequest;
use App\Projeto;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminAvaliadorController extends Controller
{

    private $avaliador;

    use RegistersUsers;

    public function __construct(Avaliador $avaliador)
    {
        $this->avaliador = $avaliador;
    }

    public function index()
    {
        try {
            $avaliadores = Avaliador::orderBy('name', 'asc')
                ->paginate(10);
            $quantidade = count(Avaliador::all());
            return view("admin.avaliador.home", compact('avaliadores', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '120');
        }
    }

    public function create()
    {
        try {
            $titulo = 'Cadastrar avaliador';
            return view('admin.avaliador.cadastro', compact('titulo'));
        } catch (\Exception $e) {
            return abort(100, '121');
        }
    }

    public function store(AvaliadorCreateFormRequest $request)
    {
        try {
            $dataForm = $request->all() + ['tipoUser' => 'avaliador'];
            $user = User::create([
                'name' => $dataForm['name'],
                'username' => $dataForm['username'],
                'email' => $dataForm['email'],
                'password' => bcrypt($dataForm['password']),
                'tipoUser' => $dataForm['tipoUser'],
            ]);

            $avaliador = Avaliador::create($dataForm + ['user_id' => $user->id]);

            $endereco = Endereco::create($dataForm + ['user_id' => $user->id]);

            Session::put('mensagem', "O avaliador " . $avaliador->name . " foi salvo com sucesso!");

            return redirect()->route("admin.avaliador");
        } catch (\Exception $e) {
            return abort(100, '122');
        }
    }

    public function show($id)
    {
        try {
            $avaliador = Avaliador::findOrFail($id);
            return view("admin.avaliador.show", compact('avaliador'));
        } catch (\Exception $e) {
            return abort(100, '123');
        }
    }

    public function edit($id)
    {
        try {
            $avaliador = Avaliador::findOrFail($id);
            $titulo = 'Editar avaliador: ' . $avaliador->name;

            return view("admin.avaliador.cadastro", compact('avaliador', 'titulo'));
        } catch (\Exception $e) {
            return abort(100, '124');
        }
    }

    public function update(AvaliadorUpdateFormRequest $request, $id)
    {
        try {
            $dataForm = $request->all() + ['tipoUser' => 'avaliador'];
            $user = User::findOrFail($id);

            $avaliador = $user->avaliador;
            $avaliador->update($dataForm);

            $endereco = $user->endereco;
            $endereco->update($dataForm);

            Session::put('mensagem', "O avaliador " . $avaliador->name . " foi editado com sucesso!");

            $avaliadores = $this->avaliador->all();
            return redirect()->route("admin.avaliador", compact('avaliadores'));
        } catch (\Exception $e) {
            return abort(100, '125');
        }
    }

    public function filtrar(Request $request)
    {
        $dataForm = $request->all();
        try {
            $avaliadores = null;
            if ($dataForm['tipo'] == 'id') {
                $avaliadores = Avaliador::where('id', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'nome') {
                $filtro = '%' . $dataForm['search'] . '%';
                $avaliadores = Avaliador::where('name', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'cpf') {
                $avaliadores = Avaliador::where('cpf', '=', $dataForm['search'])->paginate(10);
            } else if ($dataForm['tipo'] == 'sexo') {
                $filtro = '%' . $dataForm['search'] . '%';
                $avaliadores = Avaliador::where('sexo', 'like', $filtro)->paginate(10);
            } else if ($dataForm['tipo'] == 'projetos') {
                $avaliadores = Avaliador::where('projetos', '=', $dataForm['search'])->paginate(10);
            }
            $quantidade = $avaliadores->total();
            return view('admin.avaliador.home', compact('avaliadores', 'quantidade'));
        } catch (\Exception $e) {
            return abort(100, '126');
        }
    }

    public function destroy($id)
    {
        try {
            $avaliador = Avaliador::findOrFail($id);
            $avaliador->user()->delete($id);

            Session::put('mensagem', "O avaliador " . $avaliador->name . " foi deletado com sucesso!");
        } catch (\Exception $e) {
            return abort(100, '127');
        }
    }

    public function atribuir($id)
    {
        try {
            $projetos = Projeto::where('ano', '=', intval(date("Y")))
                ->where('tipo', '=', 'normal')
                ->where('avaliadores', '<', '3')
                ->paginate(10);
            $avaliador = Avaliador::findOrFail($id);

            return view('admin.avaliador.atribuir', compact('projetos', 'avaliador'));
        } catch (\Exception $e) {
            return abort(100, '128');
        }
    }

    public function atribui(Request $request)
    {
        $dataForm = $request->all();
        try {
            $projeto = Projeto::findOrFail($dataForm['projeto_id']);
            $avaliador = Avaliador::findOrFail($dataForm['avaliador_id']);
            $avaliador->projeto()->attach($projeto->id);
            $qnt = $projeto->avaliadores + 1;
            $projeto->update(['avaliadores' => $qnt]);

            return view('admin.avaliador.atribuir');
        } catch (\Exception $e) {
            return abort(100, '128.1');
        }
    }

    public function vincularProjetos($id)
    {
        try {
            $avaliador = Avaliador::findOrFail($id);
            $categorias = Categoria::all();
            return view('admin.avaliador.vincular-projetos', compact('avaliador', 'categorias'));
        } catch (\Exception $e) {
            return abort(100, '128.2');
        }
    }

    public function desvincularProjetos($id)
    {
        try {
            $avaliador = Avaliador::findOrFail($id);
            return view('admin.avaliador.desvincular-projetos', compact('avaliador'));
        } catch (\Exception $e) {
            return abort(100, '128.3');
        }
    }

    public function desvinculaProjetos($id)
    {
        try {
            $avaliador = Avaliador::findOrFail(Session::get('id'));
            $projeto = Projeto::findOrFail($id);
            $avaliador->projeto()->detach($id);
            $tamanho = $avaliador->projetos;
            $avaliador->projetos = $tamanho - 1;
            $avaliador->save();
            $tamanho = $projeto->avaliadores;
            $projeto->avaliadores = $tamanho - 1;
            $projeto->save();
            return redirect()->route("admin.avaliador");
        } catch (\Exception $e) {
            return abort(100, '128.4');
        }
    }

    public function vinculaProjetos(Request $request)
    {
        try {
            $dataForm = $request->all();
            $avaliador = Avaliador::findOrFail(Session::get('id'));
            $avaliador->projeto()->attach($dataForm['projeto']);
            $tamanho = $avaliador->projetos;
            $avaliador->projetos = $tamanho + 1;
            $avaliador->save();
            $projeto = Projeto::findOrFail($dataForm['projeto']);
            $tamanho = $projeto->avaliadores;
            $projeto->avaliadores = $tamanho + 1;
            $projeto->save();
            return redirect()->route("admin.avaliador");
        } catch (\Exception $e) {
            return abort(100, '128.5');
        }
    }

    public function projetoAjax()
    {
        $categoria = Input::get('categoria');
        $projetos = Projeto::all()
            ->where('categoria_id', '=', $categoria)
            ->where('ano', '=', intval(date("Y")))
            ->where('avaliadores', '<', '3')
            ->where('tipo', '=', 'normal');
        return response()->json($projetos);
    }

}
