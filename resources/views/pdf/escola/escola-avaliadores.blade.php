<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Avaliadores por escola</title>

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
@foreach ($escolas as $escola)
    <div class="header">
        <img src="{{public_path('images/LOGO_PMSL (2).png')}}" class="pmsl">

        <img src="{{public_path('images/motic-logo (2).png')}}" class="motic">
    </div>
    <h2>Dados da escola</h2>
    <hr>
    <ul>
        <li>Nome: {{$escola->name}}</li>
        <li>Telefone: {{$escola->telefone}}</li>
        <li>Rua: {{$escola->user->endereco->rua}}</li>
        <li>Número: {{$escola->user->endereco->numero}}</li>
        <li>Complemento: {{$escola->user->endereco->complemento}}</li>
        <li>Bairro: {{$escola->user->endereco->bairro}}</li>
        <li>CEP: {{$escola->user->endereco->cep}}</li>
        <li>Cidade: {{$escola->user->endereco->cidade}}</li>
        <li>Estado: {{$escola->user->endereco->estado}}</li>
        <li>País: {{$escola->user->endereco->pais}}</li>
    </ul>
    <h2>Categorias</h2>
    <hr>
    <ul>
        @foreach($escola->categoria as $categoria)
            <li>{{$categoria->categoria}}</li>
        @endforeach
    </ul>
    <h2>Avaliadores</h2>
    <hr>
    <ul>
        @foreach($escola->projeto as $projeto)
            @foreach ($projeto->avaliador as $avaliador)
                <li>{{$projeto->titulo}} - {{$avaliador->name}} </li>
            @endforeach
        @endforeach
    </ul>
    <div class="page-break"></div>
@endforeach
</body>
</html>