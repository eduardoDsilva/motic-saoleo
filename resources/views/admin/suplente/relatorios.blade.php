@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.suplente')}}" class="breadcrumb">Suplentes</a>
    <a href="{{route ('admin.suplente.relatorios')}}" class="breadcrumb">Relatórios</a>
@endsection

@section('content')

@section('titulo-header', 'Relatórios projetos suplentes')

@section('conteudo-header', 'Esses são os relatórios dos projetos suplentes disponíveis no sistema!')

@includeIf('_layouts._sub-titulo')

<div class="section container col s12 m4 l8">
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card small red darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Todos projetos suplentes</span>
                        <p>Para gerar um relatório de todos os dados dos projetos suplentes do sistema</p>
                    </div>
                    <div class="card-action">
                        <a class="btn" target="_blank" href="{{route('admin.suplente.relatorios.todos-projetos')}}">Relatório</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small blue darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Projeto suplente por categoria</span>
                        <p>Para gerar um relatório dos projetos suplentes por categoria do sistema.</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" data-target="modal3" href="#modal3" type="submit">Relatório
                        </button>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card small green darken-4 hoverable">
                    <div class="card-content white-text">
                        <span class="card-title">Projeto suplente individual</span>
                        <p>Para gerar um relatório de um projeto suplente específico do sistema.</p>
                    </div>
                    <div class="card-action">
                        <button class="modal-trigger btn" target="_blank" type="submit" data-target="modal1"
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
                  action="{{route('admin.suplente.relatorios.filtro-projetos')}}">
                <div class="row">
                    <div class="input-field col s4">
                        <select name="tipo" required>
                            <option value="" disabled selected>Filtrar por...</option>
                            <option value="id">ID</option>
                            <option value="nome">Nome</option>
                            <option value="escola">Escola</option>
                        </select>
                        <label>Filtros</label>
                    </div>

                    <div class="input-field col s7">
                        <input id="search" type="search" name="search" required>
                        <label for="search">Pesquise no sistema...</label>
                    </div>
                    {{csrf_field()}}
                    <div class="input-field col s1">
                        <button type="submit" class="btn-floating"><i class="material-icons">search</i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($projetos as $projeto)
                    <tr>
                        <td>{{$projeto->id}}</td>
                        <td>{{$projeto->titulo}}</td>
                        <td>
                            <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Gerar relatório"
                               target="_blank" href="{{route('admin.suplente.relatorios.projeto-individual', $projeto->id)}}"><i
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
            {{ $projetos->appends(request()->input())->links() }}
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal3" class="modal">
    <div class="modal-content">
        <h4>Categorias</h4>

        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->id}}</td>
                        <td>{{$categoria->categoria}}</td>
                        <td>
                            <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Gerar relatório"
                               target="_blank" href="{{route('admin.suplente.relatorios.categoria-projetos', $categoria->id)}}"><i
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