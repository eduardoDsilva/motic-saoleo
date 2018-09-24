<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Todos alunos</title>

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
<h2>Alunos do sistema</h2>
<table>
    <tr>
        <th>Nome</th>
        <th>Ano/Etapa</th>
        <th>Escola</th>
        <th>Turma</th>
        <th>Projeto</th>
    </tr>
    @foreach ($alunos as $aluno)
        <tr>
            <td>{{$aluno->name}}</td>
            <td>{{$aluno->etapa}}</td>
            <td>{{$aluno->escola->name}}</td>
            <td>{{$aluno->turma}}</td>
            <td>{{($aluno->projeto_id == null ? "" : $aluno->projeto->titulo)}}</td>
        </tr>
    @endforeach
</table>

</body>
</html>