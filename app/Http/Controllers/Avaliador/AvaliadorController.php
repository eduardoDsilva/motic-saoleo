<?php

namespace App\Http\Controllers\Avaliador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvaliadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('avaliador/home');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }
}
