@extends('_layouts._app')

@section('titulo','Motic - Votação Popular')

@section('content')

    @php
        $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
        $data = new \DateTime();
        $nova_data = date('Y-m-d', strtotime($data->format('Y-m-d')));
        $nova_hora = date('H:i:s', strtotime($data->format('H:i:s')));

        $de = date('Y-m-d', strtotime($avaliacao->data_inicio));
        $hora_inicial = date('H:i:s', strtotime($avaliacao->hora_inicio));
        $ate = date('Y-m-d', strtotime($avaliacao->data_fim));
        $hora_final = date('H:i:s', strtotime($avaliacao->hora_fim));

        if(($nova_data >= $de) && ($nova_hora >= $hora_inicial) && ($nova_data <= $ate) && ($nova_hora <= $hora_final)) {
    @endphp

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">Votação Popular</h1>
        </div>
    </div>

    <div class="section container">
        <div class="card-panel">
            <div class="row">
                @if(Session::get('mensagem'))
                    @include('_layouts._mensagem-sucesso')
                @endif
                <blockquote>Para dar o seu voto à um projeto da MOTIC, você deve primeiro selecionar a categoria do projeto, e então o sistema irá carregar os projetos desta categoria selecionada.</blockquote>
                <div class="input-field col s12 m12 l12">
                    <select name="projeto" id="projeto" required>
                        <option value="" disabled selected>Categoria...</option>
                        @forelse($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                        @empty
                            <option>Sem projetos dessa categoria</option>
                        @endforelse
                    </select>
                    <label>Categorias</label>
                </div>
                <form method="post" action="{{route('avaliacao-popular-escolha')}}">
                    {{csrf_field()}}
                    <div class="input-field col s12 m12 l12">
                        <select name="projeto" id="projetos" required>
                            <option value="" disabled selected>Projetos...</option>
                        </select>
                        <label>Projetos</label>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m4 l4">
                            {!! Form::captcha() !!}
                        </div>
                        <div class="input-field col s12 m12 l12">
                            <div class="row">
                                <button type="submit" class="btn-large col s12 tooltipped blue darken-4" data-position="top" data-delay="50"
                                        data-tooltip="Votar"><i class="material-icons">check</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @php
        }
    @endphp

@endsection

