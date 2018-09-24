<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Aluno {{$aluno->name}}</title>

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
    <li>Nome: {{$aluno->name}}</li>
    <li>Data de Nascimento: {{$aluno->nascimento}}</li>
    <li>Sexo: {{$aluno->sexo}}</li>
    <li>Telefone: {{$aluno->telefone}}</li>
    <li>E-mail: {{$aluno->email}}</li>
    <li>CPF: {{$aluno->cpf}}</li>
    <li>Etapa: {{$aluno->etapa}}</li>
    <li>Turma: {{$aluno->turma}}</li>
    <li>Escola: {{$aluno->escola->name}}</li>
    <li>Camisa: {{$aluno->camisa}}</li>
</ul>

<h2>Endereço</h2>
<hr>
<ul>
    <li>Rua: {{$aluno->rua}}</li>
    <li>Número: {{$aluno->numero}}</li>
    <li>Complemento: {{$aluno->complemento}}</li>
    <li>Bairro: {{$aluno->bairro}}</li>
    <li>CEP: {{$aluno->cep}}</li>
    <li>Cidade: {{$aluno->cidade}}</li>
    <li>Estado: {{$aluno->estado}}</li>
    <li>País: {{$aluno->pais}}</li>
</ul>

<h2>Projetos</h2>
<hr>
<ul>
    <li>{{$aluno->projeto->titulo}} </li>
    <dd>Escola: {{$aluno->projeto->escola->name}}</dd>
    <dd>Categoria: {{$aluno->projeto->categoria->categoria}}</dd>
</ul>
</body>
</html>