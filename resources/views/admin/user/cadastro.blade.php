@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.user')}}" class="breadcrumb">Usuários</a>
    @if(isset($user))
        <a href="" class="breadcrumb">Editar</a>
    @else
        <a href="{{route ('admin.user.create')}}" class="breadcrumb">Cadastro</a>
    @endif
@endsection

@section('campo-etapa')
    <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix">book</i>
        <select id='anoLetivo' name="categoria_id">
        </select>
        <label>Ano/Etapa *</label>
    </div>
@endsection

@section('content')

@section('titulo-header', 'Cadastrar admin')

@section('conteudo-header', "- Os campos com ' * ' são de preenchimento obrigatório.")

@includeIf('_layouts._sub-titulo')

<div class="container section">
    <div class="card-panel">
        <div class="row">
            @includeIf('_layouts._mensagem-erro')
            <form class="col s12" method="POST" enctype="multipart/form-data"
                  action="@if(isset($usuario)){{route('admin.user.update',$usuario->id)}}@else{{route('admin.user.store')}}@endif">
                {{csrf_field()}}
                @include('_layouts._usuario._form-usuario')
            </form>
        </div>
    </div>
</div>

@endsection
