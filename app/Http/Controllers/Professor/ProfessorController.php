<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessorController extends Controller
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
            //encaminho para a view professor.home
            return view('professor.home');
        } catch (\Exception $e) {
            return abort(300, '300');
        }
    }

}
