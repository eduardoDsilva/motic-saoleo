<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Avaliador {{$avaliador->name}}</title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .motic {
            float: right;
        }

        .pmsl {
            float: left;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            width: 100%;
            height: 320px;
            padding-bottom: 20px;
        }
    </style>

</head>

<body>

<div class="header">
    <img src="{{public_path('images/LOGO_PMSL (2).png')}}" class="pmsl">

    <img src="{{public_path('images/motic-logo (2).png')}}" class="motic">
</div>
<h2>Dados pessoais</h2>
<hr>
<ul>
    <li>Nome: {{$avaliador->name}}</li>
    <li>Data de Nascimento: {{$avaliador->nascimento}}</li>
    <li>Sexo: {{$avaliador->sexo}}</li>
    <li>Telefone: {{$avaliador->telefone}}</li>
    <li>CPF: {{$avaliador->cpf}}</li>
    <li>Grau de Instrução: {{$avaliador->grauDeInstrucao}}</li>
    <li>Instituição: {{$avaliador->instituicao}}</li>
</ul>

<h2>Endereço</h2>
<hr>
<ul>
    <li>Rua: {{$avaliador->user->endereco->rua}}</li>
    <li>Número: {{$avaliador->user->endereco->numero}}</li>
    <li>Complemento: {{$avaliador->user->endereco->complemento}}</li>
    <li>Bairro: {{$avaliador->user->endereco->bairro}}</li>
    <li>CEP: {{$avaliador->user->endereco->cep}}</li>
    <li>Cidade: {{$avaliador->user->endereco->cidade}}</li>
    <li>Estado: {{$avaliador->user->endereco->estado}}</li>
    <li>País: {{$avaliador->user->endereco->pais}}</li>
</ul>

<h2>Projetos</h2>
<hr>
<ul>
    @foreach($avaliador->projeto as $projeto)
        <li>{{$projeto->titulo}} </li>
        <dd>Escola: {{$projeto->escola->name}}</dd>
        <dd>Categoria: {{$projeto->categoria->categoria}}</dd>
    @endforeach
</ul>
</body>
</html>