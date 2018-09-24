@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.professor')}}" class="breadcrumb">Professores</a>
    <a href="{{route ('admin.professor.relatorios')}}" class="breadcrumb">Relatórios</a>
@endsection

@section('content')

@section('titulo-header', 'Relatórios professores')

@section('conteudo-header', 'Esses são os relatórios dos professores disponíveis no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container col s12 m4 l8">
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card small blue darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Todos os professores</span>
                        <p>Para gerar um relatório de todos os professores do sistema.</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" target="_blank" href="{{route('admin.professor.relatorios.todos-professores')}}">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small green darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Professores ativos</span>
                        <p>Para gerar um relatório de todos os professores vinculados a projetos ativos do sistema.</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" target="_blank" href="{{route('admin.professor.relatorios.professores-ativos')}}">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small red darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Professor individual</span>
                        <p>Para gerar um relatório de um professor específico do sistema.</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" type="submit" data-target="modal1"
                                href="#modal1">Relatório
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Projetos suplentes</h4>

        <div class="col s12 m4 l8">
            <form method="POST" enctype="multipart/form-data"
                  action="{{route('admin.professor.relatorios.filtro-professor')}}">
                <div class="row">
                    <div class="input-field col s12 m12 l4">
                        <select required name="tipo">
                            <option value="" disabled selected>Filtrar por...</option>
                            <option value="id">ID</option>
                            <option value="nome">Nome</option>
                            <option value="escola">Escola</option>
                        </select>
                        <label>Filtros</label>
                    </div>

                    <div class="input-field col s10 m11 l7">
                        <input id="search" class="tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Insira um complemento para a pesquisa" type="search" name="search"
                               required>
                        <label for="search">Pesquise no sistema...</label>
                    </div>
                    {{csrf_field()}}
                    <div class="input-field col s1 m1 l1">
                        <button type="submit" class="btn-floating tooltipped" data-position="top" data-delay="50"
                                data-tooltip="Clique aqui para pesquisar"><i class="material-icons">search</i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($professores as $professor)
                    <tr>
                        <td>{{$professor->id}}</td>
                        <td>{{$professor->name}}</td>
                        <td>
                            <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Gerar relatório" target="_blank"
                               href="{{route('admin.professor.relatorios.professor-individual', $professor->id)}}"><i
                                        class="small material-icons">chrome_reader_mode</i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhum projeto encontrado</td>
                        <td>Nenhum projeto encontrado</td>
                        <td>Nenhum projeto encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $professores->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@section('modal')
    @if(isset($modal))
        $(document).ready(function(){
        $('#modal1').modal('open');
        });
    @endif
@endsection

@endsection