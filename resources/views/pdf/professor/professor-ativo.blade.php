<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Todos professores</title>

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
            padding-bottom: 20px;
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
<h2>Professores ativos do sistema</h2>
<table>
    <tr>
        <th>Nome</th>
        <th>Ano/Etapa</th>
        <th>Escola</th>
        <th>Projeto</th>
    </tr>
    @foreach ($professores as $professor)
        @if($professor->projeto != null)
            @if($professor->projeto->tipo == "normal")
                <tr>
                    <td>{{$professor->name}}</td>
                    <td>{{$professor->escola->name}}</td>
                    <td>{{$professor->tipo}}</td>
                    <td>@if($professor->projeto_id == null) @else{{$professor->projeto->titulo}}@endif</td>
                </tr>
            @endif
        @endif
    @endforeach
</table>

</body>
</html>