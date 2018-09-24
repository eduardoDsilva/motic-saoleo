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
@foreach($avaliador->projeto as $projeto)
    <h2>{{$projeto->titulo}}</h2>
    <hr>
    <ul>
        <li>Área: {{$projeto->area}}</li>
        <li>Escola: {{$projeto->escola->name}}</li>
        <li>Categoria: {{$projeto->categoria->categoria}}</li>
        <li>Resumo: {{$projeto->resumo}}</li>
        <li>Estande: {{$projeto->estande}}</li>
    </ul>
    <h3>Disciplinas</h3>
    <hr>
    <ul>
        @foreach($projeto->disciplina as $disciplinas)
            <li>{{$disciplinas->name}}</li>
        @endforeach
    </ul>
    <h3>Alunos</h3>
    <hr>
    <ul>
        @foreach($projeto->aluno as $aluno)
            <li>{{$aluno->name}}</li>
        @endforeach
    </ul>
    <h3>Professores</h3>
    <hr>
    <ul>
        @foreach($projeto->professor as $professor)
            <li>{{$professor->name}} - {{$professor->tipo}}</li>
        @endforeach
    </ul>
    <div class="page-break"></div>
@endforeach
</body>
</html>