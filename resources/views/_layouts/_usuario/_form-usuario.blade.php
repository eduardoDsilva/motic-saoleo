<div class="section">
    <div class="row">
        <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">perm_identity</i>
            <input minlength="2" id="name" class="validate" type="text" name="name"
                   value="{{$usuario->name or old('name')}}" required>
            <label data-error="Insira um nome válido!" data-success="Ok" for="name">Nome
                *</label>
        </div>
        <div class="input-field col s12 m12 l6">
            <i class="material-icons prefix">person</i>
            <label for="username">Usuário *</label>
            <input type="text" name="username" value="{{$usuario->username or old('username')}}"
                   required>
        </div>
        <div class="input-field col s12 m12 l6">
            <i class="material-icons prefix">email</i>
            <input minlength="10" class='validate' id='email' type="email" name="email"
                   value="{{$usuario->email or old('email')}}" required>
            <label data-error="Insira um e-mail válido!" data-success="Ok"
                   for="email">Email *</label>
        </div>
        @if(!isset($usuario))
            <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">lock</i>
                <label for="password">Senha *</label>
                <input type="password" name="password" value="{{old('password')}}" required>
            </div>

            <div class="input-field col s12 m6 l6">
                <i class="material-icons prefix">lock</i>
                <label for="password_confirmation">Confirmar senha *</label>
                <input type="password" name="password_confirmation" value="{{old('password')}}" required>
            </div>
        @endif
        <div class="center-align">
            <button class="waves-effect waves-light btn" type="submit"><i
                        class="material-icons right">send</i>salvar
            </button>
        </div>
    </div>
</div>