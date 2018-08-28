@extends('_layouts._app')

@section('titulo','MOTIC - Recuperar Senha')

@section('content')

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">Recuperar senha</h1>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="col s12 z-depth-4 card-panel">
                @if(Session::get('mensagem'))
                    <div class="center-align">
                        <div class="chip red">
                            {{Session::get('mensagem')}}
                            <i class="close material-icons">close</i>
                        </div>
                    </div>
                    {{Session::forget('mensagem')}}
                @endif
                @includeIf('_layouts._mensagem-erro')
                <div class="row">
                    <blockquote>Insira o seu e-mail cadastrado no sistema. Você receberá um link para recadastrar sua senha.</blockquote>
                    <form method="POST"
                          action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="input-field">
                            <i class="material-icons prefix">mail</i>
                            <input type="text" name="email" required value="{{old('email')}}">
                            <label>E-mail</label>
                        </div>
                        <button type="submit" class="btn waves-effect waves-light col s12 green">Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
