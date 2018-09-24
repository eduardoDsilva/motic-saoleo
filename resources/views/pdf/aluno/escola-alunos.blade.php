<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Alunos por escola</title>

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
    <h2>{{$escola->name}}</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Ano/Etapa</th>
            <th>Turma</th>
            <th>Projeto</th>
        </tr>
        @foreach ($escola->aluno as $aluno)
            <tr>
                <td>{{$aluno->name}}</td>
                <td>{{$aluno->nascimento}}</td>
                <td>{{$aluno->etapa}}</td>
                <td>{{$aluno->turma}}</td>
                <td>{{($aluno->projeto_id == null ? ($aluno->projeto_id == null ? "Sem projeto" : $aluno->projeto->titulo) : $aluno->projeto->titulo)}}</td>
            </tr>
        @endforeach
        <div class="page-break"></div>
    </table>
@endforeach
</body>
</html>