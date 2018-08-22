<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Avaliacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminConfigAvaliacoesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.admin');
    }

    public function index()
    {
        try {
            $datas = Avaliacao::latest()->first();
            return view('admin.config.avaliacoes', compact('datas'));
        } catch (\Exception $e) {
            return abort(100,  '140');
        }
    }

    public function store(Request $request)
    {
        try {
            $dataForm = $request->all();
            $avaliacao = Avaliacao::create($dataForm);

            Session::put('mensagem', "O período de avaliação foi salvo com sucesso!");
            return redirect()->route("admin.config.avaliacoes");
        } catch (\Exception $e) {
            return abort(100,  '141');
        }
    }

    public function edit()
    {
        try {

        } catch (\Exception $e) {
            return abort(100,  '142');
        }
    }

    public function update()
    {
        try {

        } catch (\Exception $e) {
            return abort(100,  '143');
        }
    }

    public function destroy()
    {
        try {

        } catch (\Exception $e) {
            return abort(100,  '144');
        }
    }
}