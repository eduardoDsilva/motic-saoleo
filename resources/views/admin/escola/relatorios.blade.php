@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.escola')}}" class="breadcrumb">Escolas</a>
    <a href="{{route ('admin.escola.relatorios')}}" class="breadcrumb">Gerar relatórios</a>
@endsection

@section('content')

    @section('titulo-header', 'Relatórios escolas')

    @section('conteudo-header', 'Esses são os relatórios das escolas disponíveis no sistema!')

    @includeIf('_layouts._sub-titulo')

    <div class="section container col s12 m4 l8">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card small blue darken-4 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title flow text">Todas escolas</span>
                            <p>Para gerar um relatório completo de todas escolas do sistema.</p>
                            <li>Dados da escola</li>
                            <li>Endereço da escola</li>
                            <li>Projetos da escola</li>
                        </div>
                        <div class="card-action">
                            <a class="btn" target="_blank" href="{{route ('admin.escola.relatorios.todas.escolas')}}">Gerar
                                relatório</a>
                        </div>
                    </div>
                </div>

                <div class="col s12 m12 l6">
                    <div class="card small red darken-4 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title flow text">Escola específica</span>
                            <p>Para gerar um relatório com os dados de uma escola específica.</p>
                        </div>
                        <div class="card-action">
                            <button class="modal-trigger btn" data-target="modal" href="#modal1" href="">Gerar relatório</button>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="col s12 m12 l6">
                    <div class="card small purple darken-4 hoverable">
                        <div class="card-content white-text">
                            <span class="card-title flow text">Avaliadores da escola</span>
                            <p>Para gerar um relatório de todos os avaliadores vinculados à escola.</p>
                        </div>
                        <div class="card-action">
                            <a class="btn" target="_blank" href="{{route ('admin.escola.relatorios.escola-avaliador')}}">Gerar relatório</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@if(isset($escolas))
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Escolas</h4>

            <div class="col s12 m4 l8">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ route("admin.escola.relatorios.filtrar") }}">
                    @includeIf('_layouts._escola._filtro-escola')
                </form>
            </div>
            <div class="row">
                <table class="centered responsive-table highlight bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($escolas as $escola)
                        <tr>
                            <td>{{$escola->id}}</td>
                            <td>{{$escola->name}}</td>
                            <td>{{$escola->user->username}}</td>
                            <td>
                                <a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Gerar relatório" target="_blank"
                                   href="{{route ('admin.escola.relatorios.escola-individual', $escola->id)}}"><i
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
                {{ $escolas->appends(request()->input())->links() }}
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