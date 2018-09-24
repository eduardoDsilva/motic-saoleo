<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Professor {{$professor->name}}</title>

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
    <li>Nome: {{$professor->name}}</li>
    <li>Data de Nascimento: {{$professor->nascimento}}</li>
    <li>Sexo: {{$professor->sexo}}</li>
    <li>Telefone: {{$professor->telefone}}</li>
    <li>CPF: {{$professor->cpf}}</li>
    <li>Matrícula: {{$professor->matricula}}</li>
    <li>Escola: {{$professor->escola->name}}</li>
    <li>Grau de Instrução: {{$professor->grauDeInstrucao}}</li>
    <li>Função: {{$professor->tipo}}</li>
    <li>Camisa: {{$professor->camisa}}</li>
</ul>

<h2>Endereço</h2>
<hr>
<ul>
    <li>Rua: {{$professor->user->endereco->rua}}</li>
    <li>Número: {{$professor->user->endereco->numero}}</li>
    <li>Complemento: {{$professor->user->endereco->complemento}}</li>
    <li>Bairro: {{$professor->user->endereco->bairro}}</li>
    <li>CEP: {{$professor->user->endereco->cep}}</li>
    <li>Cidade: {{$professor->user->endereco->cidade}}</li>
    <li>Estado: {{$professor->user->endereco->estado}}</li>
    <li>País: {{$professor->user->endereco->pais}}</li>
</ul>

<h2>Projeto</h2>
<hr>
<ul>
        <li>{{$professor->projeto->titulo}} </li>
        <dd>Escola: {{$professor->projeto->escola->name}}</dd>
        <dd>Categoria: {{$professor->projeto->categoria->categoria}}</dd>
        <dd>Tipo: {{$professor->projeto->tipo}}</dd>
</ul>
</body>
</html>