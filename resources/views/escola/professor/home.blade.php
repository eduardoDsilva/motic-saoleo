@extends('layout.site')

@section('titulo','Motic Escola')

@section('breadcrumb')
    <a href="{{{route ('escola/home')}}}" class="breadcrumb">Home</a>
    <a href="{{{route ('escola/professor/home')}}}" class="breadcrumb">Professores</a>
@endsection

@section('conteudo')

    @if(Session::get('mensagem'))
        <div class="center-align">
            <div class="chip green">
                {{Session::get('mensagem')}}
                <i class="close material-icons">close</i>
            </div>
        </div>
        {{Session::forget('mensagem')}}
    @endif

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">Professores</h1>
            <div class="row center">
                <h5 class="header col s12 light">Esses são os professores da sua escola!</h5>
            </div>
        </div>
    </div>

    <div class="section container">
        <div class="card-panel">

            <div class="col s12 m4 l8">
                <form method="POST" enctype="multipart/form-data" action="{{ url("escola/escola/show") }}">
                    <div class="row">
                        <div class="input-field col s4">
                            <select required>
                                <option value="" disabled selected>Filtrar por...</option>
                                <option value="id">ID</option>
                                <option value="user">Usuário</option>
                                <option value="nome">Nome</option>
                                <option value="nscimento">Nascimento</option>
                                <option value="sexo">Sexo</option>
                                <option value="grauDeInstrucao">Grau de instrução</option>
                                <option value="cpf">CPF</option>
                            </select>
                            <label>Filtros</label>
                        </div>

                        <div class="input-field col s7">
                            <input id="search" type="search">
                            <label for="search">Pesquise no sistema...</label>
                        </div>
                        {{csrf_field()}}
                        <div class="input-field col s1">
                            <a class="btn-floating "><i class="material-icons">search</i></a>
                        </div>
                    </div>
                </form>
            </div>

            <table class="centered responsive-table highlight bordered">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Projeto</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($professores as $professor)
                    <tr>
                        <td>{{$professor->id}}</td>
                        <td>{{$professor->name}}</td>
                        <td>{{$professor->user->username}}</td>
                        <td>{{($professor->projeto_id == null ? "Professor sem projeto" : $professor->projeto->titulo )}}</td>
                        <td>{{($professor->projeto_id == null ? "Professor sem projeto" : $professor->tipo )}}</td>
                        <td>
                            <a class="modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Editar"  href="{{ url("/escola/professor/update/".$professor->id."/edita") }}"><i class="small material-icons">edit</i></a>
                            <a data-target="modal1" class="modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Deletar"  href="#modal1" data-id="{{$professor->id}}" data-name="{{$professor->name}}"> <i class="small material-icons">delete</i></a>
                            <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Visualizar"  href="{{ url("/escola/professor/show/".$professor->id) }}"> <i class="small material-icons">library_books</i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhum professor encontrado</td>
                        <td>Nenhum professor encontrado</td>
                        <td>Nenhum professor encontrado</td>
                        <td>Nenhum professor encontrado</td>
                        <td>Nenhum professor encontrado</td>
                        <td>Nenhum professor encontrado</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Deletar</h4>
                    <p>Você tem certeza que deseja deletar o professor abaixo?</p>
                    <div class="row">
                        <label for="id_delete">ID</label>
                        <div class="input-field col s12">
                            <input disabled class="validate" type="number" id="id_delete">
                        </div>
                    </div>
                    <div class="row">
                        <label for="name_delete">Nome do professor</label>
                        <div class="input-field col s12">
                            <input disabled class="validate" type="text" id="name_delete">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn red delete">Sim</a>
                </div>
            </div>

            <div class="fixed-action-btn">
                <a class="btn-floating btn-large waves-effect waves-light red tooltipped  modal-trigger" data-position="top" data-delay="50" data-tooltip="Adicionar professor" href="{{route ('escola/professor/cadastro/registro')}}"><i class="material-icons">add</i></a>
            </div>

        </div>
        </div>
    </div>

@endsection