@extends('layouts.app')

@section('titulo', $titulo)

@section('breadcrumb')
    <a href="{{{route ('admin/home')}}}" class="breadcrumb">Home</a>
    <a href="{{{route ('admin/escola/home')}}}" class="breadcrumb">Escolas</a>
    @if(isset($escola))
        <a href="" class="breadcrumb">Editar</a>
    @else
        <a href="{{{route ('admin/aluno/cadastro/registro')}}}" class="breadcrumb">Cadastro</a>
    @endif
@endsection

@section('content')

    @if( isset($errors) && count($errors) > 0 )
        <div class="center-align">
            @foreach( $errors->all() as $error )
                <div class="chip red">
                    {{$error}}
                    <i class="close material-icons">close</i>
                </div>
            @endforeach
        </div>
    @endif

    <div class="section container">
        <div class="card-panel">
            <div class="row">
                <h3 class="center-align">@if(isset($escola)) Editar escola: {{$escola->name}} @else Cadastrar
                    escola @endif</h3>
                @if(isset($escola))
                    <form class="col s12" method="POST" enctype="multipart/form-data"
                          action="{{ url("/admin/escola/".$escola->user->id) }}@else {{ route('admin/escola/cadastro/registro') }}@endif">
                        {{csrf_field()}}
                        <h5>Dados básicos</h5>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">perm_identity</i>
                                <input minlength="2" id="name" class="validate" type="text" name="name"
                                       value="{{$escola->name or old('name')}}" required>
                                <label data-error="Insira um nome válido!" data-success="Ok" for="name">Nome da
                                    escola</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix">school</i>
                                <select multiple name="categoria_id[]" required>
                                    <option value="" disabled selected>Categoria...</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}"
                                                @if (isset($escola) && in_array($categoria->id, $categoria_escola)) selected @endif>{{$categoria->categoria}}</option>
                                    @endforeach
                                </select>
                                <label>Categorias</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">email</i>
                                <input minlength="10" class='validate' id='email' type="email" name="email"
                                       value="{{$escola->user->email or old('email')}}" required>
                                <label data-error="Insira um e-mail válido!" data-success="Ok"
                                       for="email">Email</label>
                            </div>

                            <div class="input-field col s6">
                                <i class="material-icons prefix">local_phone</i>
                                <input id="telefone" class="validate" type="number" name="telefone"
                                       data-length="16" value="{{$escola->telefone or old('telefone')}}"
                                       required>
                                <label data-error="Insira um telefone válido!" data-success="Ok"
                                       for="telefone">Telefone</label>
                            </div>
                        </div>

                        <h5>Endereço</h5>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">explore</i>
                                <input class="validate" id="cep" type="number" name="cep" data-length="8"
                                       value="{{$escola->user->endereco->cep or old('cep')}}" required>
                                <label data-error="Insira um cep válido!" data-success="Ok"
                                       for="cep">CEP</label>
                            </div>

                            <div class="input-field col s6">
                                <i class="material-icons prefix">business</i>
                                <input id="bairro" class="validate" type="text" name="bairro"
                                       value="{{$escola->user->endereco->bairro or old('bairro')}}" required>
                                <label data-error="Insira um bairro válido!" data-success="Ok"
                                       for="bairro">Bairro</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <i class="material-icons prefix">home</i>
                                <input class="validate" id="rua" type="text" name="rua"
                                       value="{{$escola->user->endereco->rua or old('rua')}}" required>
                                <label data-error="Insira uma rua válida!" data-success="Ok"
                                       for="rua">Rua</label>
                            </div>

                            <div class="input-field col s4">
                                <i class="material-icons prefix">filter_1</i>
                                <input class="validate" id="numero" type="number" name="numero"
                                       value="{{$escola->user->endereco->numero or old('numero')}}" required>
                                <label data-error="Insira um número válido!" data-success="Ok"
                                       for="numero">N°</label>
                            </div>

                            <div class="input-field col s4">
                                <i class="material-icons prefix">home</i>
                                <input type="text" name="complemento"
                                       value="{{$escola->user->endereco->complemento or old('complemento')}}">
                                <label for="complemento">Complemento</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <i class="material-icons prefix">location_city</i>
                                <input id="cidade" class="validate" type="text" name="cidade"
                                       value="São Leopoldo"
                                       value="{{$escola->user->endereco->cidade or old('cidade')}}" required>
                                <label data-error="Insira uma cidade válida!" data-success="Ok"
                                       for="cidade">Cidade</label>
                            </div>

                            <div class="input-field col s4">
                                <i class="material-icons prefix">location_city</i>
                                <input id="estado" class="validate" type="text" name="estado"
                                       value="Rio Grande do Sul"
                                       value="{{$escola->user->endereco->estado or old('estado')}}" required>
                                <label data-error="Insira um estado válido!" data-success="Ok"
                                       for="estado">Estado</label>
                            </div>

                            <div class="input-field col s4">
                                <i class="material-icons prefix">location_city</i>
                                <input class="validate" id="pais" type="text" name="pais" value="Brasil"
                                       value="{{$escola->user->endereco->pais or old('pais')}}" required>
                                <label data-error="Insira um país válido!" data-success="Ok"
                                       for="pais">País</label>
                            </div>
                        </div>

                        <h5>Usuário</h5>

                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input id="usuario" class="validate" type="text" name="username"
                                   value="{{$escola->user->username or old('usuario')}}" required>
                            <label data-error="Insira um usuário válido!" data-success="Ok"
                                   for="usuario">Usuário</label>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="password" class="validate" type="password" name="password"
                                       value="{{old('password')}}" required>
                                <label data-error="Insira uma senha válida!" data-success="Ok"
                                       for="password">Senha</label>
                            </div>

                            <div class="input-field col s6">
                                <i class="material-icons prefix">person_pin</i>
                                <input class="validate" id="password_confirmation" type="password"
                                       name="password_confirmation" value="{{old('password')}}" required>
                                <label data-error="Insira uma senha válida!" data-success="Ok"
                                       for="password_confirmation">Confirmar senha</label>
                            </div>
                        </div>

                        <p class="center-align">
                            <button class="waves-effect waves-light btn" type="submit"><i
                                        class="material-icons right">send</i>salvar
                            </button>
                        </p>

                    </form>
            </div>
        </div>
    </div>

@endsection
