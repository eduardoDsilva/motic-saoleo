@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.projeto')}}" class="breadcrumb">Projetos</a>
    <a href="{{route ('admin.avaliacao.projetos-nao-avaliados')}}" class="breadcrumb">projetos não avaliados</a>
@endsection

@section('content')

@section('titulo-header', 'Projetos não avaliados')

@section('conteudo-header', 'Esses são os projetos que ainda não foram avaliados.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
        </div>

        <div class="center-align">
            <div class="chip">
                Atualmente, {{$quantidade}} projetos ainda não foram avaliados.
                <i class="close material-icons">close</i>
            </div>
        </div>

        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Escola</th>
                    <th>Avaliações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($projetos as $projeto)
                    <tr>
                        <td>{{str_limit($projeto->titulo,30)}}</td>
                        <td>{{$projeto->categoria->categoria}}</td>
                        <td>{{$projeto->escola->name}}</td>
                        @php
                            $avaliadores = "";
                            foreach($projeto->nota as $nota){
                                $avaliadores = $avaliadores  . $nota->avaliador->name. ", ";
                            }
                        @endphp
                        <td>@if($avaliadores != "")
                                {{$avaliadores}}
                            @endif
                        </td>
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

@includeIf('_layouts._modal-delete')

@endsection
