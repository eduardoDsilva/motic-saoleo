@extends('_layouts._app')

@section('titulo','MOTIC - Recuperar Senha')

@section('content')

    <div class="section container">
        <div class="card-panel">
            <h1 class="header center orange-text">Redefinir senha</h1>
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
                    <form method="POST"
                          action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-field">
                            <i class="material-icons prefix">mail</i>
                            <input type="text" name="email" required value="{{old('email')}}">
                            <label>E-mail</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" name="password" required>
                            <label>Senha</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" name="password_confirmation" required>
                            <label>Confirmar senha</label>
                        </div>
                        <button type="submit" class="btn waves-effect waves-light col s12 green">Redefinir senha
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection