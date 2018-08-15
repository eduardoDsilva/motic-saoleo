<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 20/07/2018
 * Time: 10:17
 */

namespace App\Http\Controllers\Audit;

use App\Access;
use App\Audit;
use App\Exports\InvoicesExport;
use App\Exports\InvoicesExportByUser;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AuditController
{

    public function index(){
        try {
            $auditorias = Audit::latest()->paginate(10);
            return view('admin.auditoria.home', compact('auditorias'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function usuarios(){
        try {
            $accesses = Access::latest()->paginate(10);
            return view('admin.auditoria.usuarios', compact('accesses'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function usuariosFiltrar(Request $request){
        try {
            $dataForm = $request->all();
            $usuario = User::where('username', '=', $dataForm['search'])->first();
            $accesses = Access::where('user_id', '=', $usuario->id)->paginate(10);
            return view('admin.auditoria.usuarios', compact('accesses'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function relatorios(){
        try {
            $usuarios = User::paginate(10);
            return view('admin.auditoria.relatorios', compact('usuarios'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function export()
    {
        try {
            return Excel::download(new InvoicesExport, 'audit.xlsx');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function exportByUser($id)
    {
        try {
            return Excel::download(new InvoicesExportByUser($id), 'audit-user:'.$id.'.xlsx');
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function filtrarUsuarios(Request $request)
    {
        try {
            $dataForm = $request->all();
            $modal2 = true;
            if ($dataForm['tipo'] == 'id') {
                $usuarios = User::where('id', '=', $dataForm['search'])->get();
            } else if ($dataForm['tipo'] == 'name') {
                $filtro = '%' . $dataForm['search'] . '%';
                $usuarios = User::where('name', 'like', $filtro)->get();
            } else if ($dataForm['tipo'] == 'username') {
                $filtro = '%' . $dataForm['search'] . '%';
                $usuarios = User::where('username', '=', $filtro)->get();
            }
            return view('admin.auditoria.relatorios', compact('usuarios', 'modal2'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

    public function filtrar(Request $request)
    {
        try {
            $dataForm = $request->all();
            if ($dataForm['tipo'] == 'id') {
                $auditorias = Audit::where('id', '=', $dataForm['search'])->paginate(5000);
            } else if ($dataForm['tipo'] == 'tipo') {
                $filtro = '%' . $dataForm['search'] . '%';
                $auditorias = Audit::where('auditable_type', 'like', $filtro)->paginate(5000);
            } else if ($dataForm['tipo'] == 'evento') {
                $filtro = '%' . $dataForm['search'] . '%';
                $auditorias = Audit::where('event', 'like', $filtro)->paginate(5000);
            } else if ($dataForm['tipo'] == 'user') {
                $filtro = '%' . $dataForm['search'] . '%';
                $user = User::where('username', 'like', $filtro)->firstOrFail();
                $auditorias = Audit::where('user_id', 'like', $user->id)->paginate(5000);
            }
            return view('admin.auditoria.home', compact('auditorias'));
        } catch (\Exception $e) {
            return abort(403, '' . $e->getMessage());
        }
    }

}