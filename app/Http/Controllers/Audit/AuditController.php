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
            //carrego os registros de auditoria do sistema em ordem da mais recente pra mais atual.
            $auditorias = Audit::latest()->paginate(10);
            //retorno para a view 'admin.auditoria.home'.
            return view('admin.auditoria.home', compact('auditorias'));
        } catch (\Exception $e) {
            return abort(1000, '1600');
        }
    }

    public function usuarios(){
        try {
            //carrego os registros dos acessos do sistema em ordem da mais recente pra mais atual.
            $accesses = Access::latest()->paginate(10);
            //retorno para a view 'admin.auditoria.usuarios'
            return view('admin.auditoria.usuarios', compact('accesses'));
        } catch (\Exception $e) {
            return abort(1000, '1610');
        }
    }

    public function usuariosFiltrar(Request $request){
        try {
            //recebo o filtro por request
            $dataForm = $request->all();
            $usuario = User::where('username', '=', $dataForm['search'])->first();
            $accesses = Access::where('user_id', '=', $usuario->id)->paginate(10);
            return view('admin.auditoria.usuarios', compact('accesses'));
        } catch (\Exception $e) {
            return abort(1000, '1620');
        }
    }

    public function relatorios(){
        try {
            //retorno os usuarios do sistema
            $usuarios = User::paginate(10);
            //encaminho para a view admin.auditoria.relatorios
            return view('admin.auditoria.relatorios', compact('usuarios'));
        } catch (\Exception $e) {
            return abort(1000, '1630');
        }
    }
    public function export()
    {
        try {
            //chamo o metodo download do Excel com base na classe InvoicesExport
            return Excel::download(new InvoicesExport, 'audit.xlsx');
        } catch (\Exception $e) {
            return abort(1000, '1640');
        }
    }

    public function exportByUser($id)
    {
        try {
            //chamo o metodo download do Excel com base na classe InvoicesExportByUser
            return Excel::download(new InvoicesExportByUser($id), 'audit-user:'.$id.'.xlsx');
        } catch (\Exception $e) {
            return abort(1000, '1650');
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
            return abort(1000, '1660');
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
            return abort(1000, '1670');
        }
    }

}