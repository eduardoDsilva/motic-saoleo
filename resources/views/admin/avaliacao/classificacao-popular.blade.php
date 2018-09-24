@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.projeto')}}" class="breadcrumb">Projetos</a>
    <a href="{{route ('admin.avaliacao.classificacao-popular')}}" class="breadcrumb">Classificação</a>
@endsection

@section('content')

@section('titulo-header', 'Classificação Popular')

@section('conteudo-header', 'Essa é a classificação popular dos projetos da MOTIC.')

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="col s12 m4 l8">
            @if(Session::get('mensagem'))
                @include('_layouts._mensagem-sucesso')
            @endif
        </div>
        <div class="row">
            <table class="centered responsive-table highlight bordered">
                <thead>
                <tr>
                    <th>Projeto</th>
                    <th>Escola</th>
                    <th>Categoria</th>
                    <th>Votos</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projetos as $projeto)
                    <tr>
                        <td>{{str_limit($projeto->titulo,30)}}</td>
                        <td>{{str_limit($projeto->escola->name,30)}}</td>
                        <td>{{str_limit($projeto->categoria->categoria,30)}}</td>
                        <td>{{str_limit($projeto->votacao_popular, 30)}}</td>
                        <td><a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"
                               href="{{ route('admin.projeto.show', $projeto->id) }}" target="_blank"> <i
                                        class="small material-icons">library_books</i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
