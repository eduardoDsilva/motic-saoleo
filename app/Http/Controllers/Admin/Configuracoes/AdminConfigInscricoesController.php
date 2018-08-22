<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminConfigInscricoesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $datas = Inscricao::latest()->first();
            return view('admin.config.inscricoes', compact('datas'));
        } catch (\Exception $e) {
            return abort(100, '147');
        }
    }

    public function store(Request $request)
    {
        try {
            $dataForm = $request->all();
            $inscricao = Inscricao::create($dataForm);

            Session::put('mensagem', "O período de inscrição foi salvo com sucesso!");
            return redirect()->route("admin.config.inscricoes");
        } catch (\Exception $e) {
            return abort(100, '147.1');
        }
    }

    public function edit()
    {
        try {

        } catch (\Exception $e) {
            return abort(100, '147.2');
        }
    }

    public function update()
    {
        try {

        } catch (\Exception $e) {
            return abort(100, '147.3');
        }
    }

    public function destroy()
    {
        try {

        } catch (\Exception $e) {
            return abort(100, '147.4');
        }
    }
}