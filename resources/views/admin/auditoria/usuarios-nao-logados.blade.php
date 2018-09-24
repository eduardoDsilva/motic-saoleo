@extends('_layouts._app')

@section('titulo','Motic Admin - Auditoria')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.auditoria')}}" class="breadcrumb">Auditoria</a>
    <a href="{{route ('admin.auditoria.usuarios-nao-logados')}}" class="breadcrumb">Usuários não logados</a>
@endsection

@section('content')

@section('titulo-header', 'Usuários que não logaram')

@section('conteudo-header', 'Esses são os registros de usuários que ainda não logaram no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Tipo usuário</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{str_limit($user->email, 25)}}</td>
                        <td>{{$user->tipoUser}}</td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhum registro encontrado</td>
                        <td>Nenhum registro encontrado</td>
                        <td>Nenhum registro encontrado</td>
                        <td>Nenhum registro encontrado</td>
                        <td>Nenhum registro encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection