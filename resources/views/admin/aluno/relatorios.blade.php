@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.aluno')}}" class="breadcrumb">Alunos</a>
    <a href="{{route ('admin.aluno.relatorios')}}" class="breadcrumb">Relatórios</a>
@endsection

@section('content')

@section('titulo-header', 'Relatórios')

@section('conteudo-header', 'Esses são os relatórios disponíveis para os alunos do sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container col s12 m4 l8">
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card small red darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Todos alunos</span>
                        <p>Para gerar um relatório de todos os alunos do sistema.</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" href="{{route ('admin.aluno.relatorios.todos.alunos')}}"
                           target="_blank">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small indigo darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Alunos ativos</span>
                        <p>Para gerar um relatório de todos os alunos vinculados a projetos ativos no sistema.</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" href="{{route ('admin.aluno.relatorios.alunos-ativos')}}"
                           target="_blank">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small green darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Aluno por escola</span>
                        <p>Para gerar um relatório dos alunos de cada escola.</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" href="{{route ('admin.aluno.relatorios.alunos.por.escola')}}"
                           target="_blank">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small blue darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Aluno individual</span>
                        <p>Para gerar um relatório de um aluno específico do sistema, insira o ID abaixo:</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" type="submit" data-target="modal1" href="#modal1">
                            Relatório
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($alunos))
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Alunos</h4>
            <div class="col s12 m4 l8">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route("admin.aluno.relatorios.filtrar") }}">
                    @includeIf('_layouts._aluno._filtro-aluno')
                </form>
            </div>
            <div class="row">
                <table class="centered responsive-table highlight bordered">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ano/Etapa</th>
                        <th>Escola</th>
                        <th>Turma</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($alunos as $aluno)
                        <tr>
                            <td>{{$aluno->id}}</td>
                            <td>{{$aluno->name}}</td>
                            <td>{{$aluno->etapa}}</td>
                            <td>{{$aluno->escola->name}}</td>
                            <td>{{$aluno->turma}}</td>
                            <td width="20%">
                                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Gerar relatório" target="_blank"
                                   href="{{route ('admin.aluno.relatorios.aluno-individual', $aluno->id)}}"><i
                                            class="small material-icons">chrome_reader_mode</i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            <td>Nenhum registro encontrado</td>
                            @if(Auth::user()->tipoUser == 'admin')
                                <td>Nenhum registro encontrado</td>
                            @endif
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $alunos->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endif

@endsection

@section('modal')
    @if(isset($modal))
        $(document).ready(function(){
        $('#modal1').modal('open');
        });
    @endif
@endsection