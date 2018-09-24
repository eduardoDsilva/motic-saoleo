@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador')}}" class="breadcrumb">Avaliador</a>
    <a href="{{route ('admin.avaliador.relatorios')}}" class="breadcrumb">Relatórios</a>
@endsection

@section('content')

@section('titulo-header', 'Relatórios avaliadores')

@section('conteudo-header', 'Esses são os relatórios dos avaliadores disponíveis no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container col s12 m4 l8">
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card small red darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Todos os avaliadores</span>
                        <p>Para gerar um relatório de todos os avaliadores do sistema com os seguintes dados:</p>
                        <li>Dados pessoais</li>
                        <li>Dados escolares</li>
                        <li>Endereço</li>
                    </div>
                    <div class="card-action">
                        <a class="btn" target="_blank" href="{{route('admin.avaliador.todos-avaliadores')}}">Gerar relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small purple darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Avaliadores e projetos</span>
                        <p>Para gerar um relatório de todos os avaliadores do sistema por projeto</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" target="_blank" href="{{route('admin.avaliador.avaliador-projetos')}}">Gerar relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small blue darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Avaliador específico</span>
                        <p>Para gerar um relatório completo de um avaliador:</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" data-target="modal" href="#modal2">Gerar relatório</button>
                    </div>
                </div>
            </div><div class="col s12 m12 l6">
                <div class="card small indigo darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Projetos do avaliador</span>
                        <p>Para gerar um relatório dos projetos de um avaliador específico do sistema.</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" data-target="modal" href="#modal1">Gerar relatório</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($avaliadores))
    <!-- Modal Structure -->
    <div id="modal2" class="modal">
        <div class="modal-content">
            <h4>Avaliadores</h4>

            <div class="col s12 m4 l8">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route("admin.avaliador.relatorios.filtrar") }}">
                    @includeIf('_layouts._avaliador._filtro-avaliador')
                </form>
            </div>
            <div class="row">
                <table class="centered responsive-table highlight bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Projetos</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($avaliadores as $avaliador)
                        <tr>
                            <td>{{$avaliador->id}}</td>
                            <td>{{$avaliador->user->name}}</td>
                            <td>{{$avaliador->user->username}}</td>
                            <td>{{$avaliador->projetos}}</td>
                            <td>
                                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Gerar relatório" target="_blank"
                                   href="{{route ('admin.avaliador.avaliador-individual', $avaliador->id)}}"><i
                                            class="small material-icons">chrome_reader_mode</i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $avaliadores->appends(request()->input())->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Avaliadores</h4>

            <div class="col s12 m4 l8">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route("admin.avaliador.relatorios.filtrar") }}">
                    @includeIf('_layouts._avaliador._filtro-avaliador')
                </form>
            </div>
            <div class="row">
                <table class="centered responsive-table highlight bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Projetos</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($avaliadores as $avaliador)
                        <tr>
                            <td>{{$avaliador->id}}</td>
                            <td>{{$avaliador->user->name}}</td>
                            <td>{{$avaliador->user->username}}</td>
                            <td>{{$avaliador->projetos}}</td>
                            <td>
                                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Gerar relatório" target="_blank"
                                   href="{{route ('admin.avaliador.relatorios.projetos-avaliador', $avaliador->id)}}"><i
                                            class="small material-icons">chrome_reader_mode</i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $avaliadores->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endif
@endsection

@section('modal')
    @if(isset($modal2))
        $(document).ready(function(){
        $('#modal2').modal('open');
        });
    @endif
@endsection