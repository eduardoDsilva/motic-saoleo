@extends('_layouts._app')

@section('titulo','Motic Avaliador')

@section('breadcrumb')
    <a href="{{route ('avaliador')}}" class="breadcrumb">Home</a>
    <a href="{{route ('avaliador.projeto')}}" class="breadcrumb">Projetos</a>
    <a href="" class="breadcrumb">Avaliação</a>
@endsection

@section('content')

    @if(Session::get('mensagem'))
        @include('_layouts._mensagem-erro')
    @endif

@section('titulo-header', 'Avaliação')

@section('conteudo-header', 'Esta é a página de availiação do projeto '.$projeto->titulo)

@includeIf('_layouts._sub-titulo')
<form action="{{route('avaliador.projeto.edita-avaliacao')}}" method="post">
    {{csrf_field()}}
    <div class="section container col s12 m6 l8">
        <div class="card-panel">
            <div class="row">
                <ul class="collection with-header col s12 m12 l12">
                    <li class="collection-header"><h4 class="center-align">Projeto</h4></li>
                    <li class="collection-item">Título: {{$projeto->titulo}}</li>
                    <li class="collection-item">Área: {{$projeto->area}}</li>
                    @if(Auth::user()->tipoUser == 'admin')
                        <li class="collection-item">Estande: {{$projeto->estande}}</li>
                    @endif
                    <li class="collection-item">Resumo: {{$projeto->resumo}}</li>
                    <li class="collection-item">Escola: {{$projeto->escola->name}}</li>
                    <li class="collection-item">Categoria: {{$projeto->categoria->categoria}}</li>
                </ul>
                <ul class="collection with-header col s12 m12 l6">
                    <li class="collection-header"><h4 class="center-align">Alunos</h4></li>
                    @foreach($projeto->aluno as $aluno)
                        <li class="collection-item">{{$aluno->name}}</li>
                    @endforeach
                </ul>
                <ul class="collection with-header col s12 m12 l6">
                    <li class="collection-header"><h4 class="center-align">Professores</h4></li>
                    @foreach($projeto->professor as $professor)
                        <li class="collection-item">{{$professor->name}} - {{$professor->tipo}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="row">
                <div class="divider"></div>

                <h3 class="center-align">Avaliação</h3>

                <div class="section">
                    <h5 class="center-align">Pensamento Cientifico (10 pontos)</h5>

                    <blockquote>
                        O trabalho apresenta as etapas do método científico: justificativa, problema, hipótese,
                        objetivos,
                        referencial teórico.
                        metodologia, resultados, análise de dados e conclusões?
                    </blockquote>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="notaUm">
                                <option value="" disabled selected>Avaliar...</option>
                                <optgroup label="Ótimo">
                                    <option value="10" @if($nota->notaUm == 10) selected @endif>10 pontos</option>
                                </optgroup>
                                <optgroup label="Muito Bom">
                                    <option value="9" @if($nota->notaUm == 9) selected @endif>9 pontos</option>
                                    <option value="8" @if($nota->notaUm == 8) selected @endif>8 pontos</option>
                                </optgroup>
                                <optgroup label="Bom">
                                    <option value="7" @if($nota->notaUm == 7) selected @endif>7 pontos</option>
                                    <option value="6" @if($nota->notaUm == 6) selected @endif>6 pontos</option>
                                </optgroup>
                                <optgroup label="Regular">
                                    <option value="5" @if($nota->notaUm == 5) selected @endif>5 pontos</option>
                                    <option value="4" @if($nota->notaUm == 4) selected @endif>4 pontos</option>
                                </optgroup>
                                <optgroup label="Insuficiente">
                                    <option value="3" @if($nota->notaUm == 3) selected @endif>3 pontos</option>
                                    <option value="2" @if($nota->notaUm == 2) selected @endif>2 pontos</option>
                                    <option value="1" @if($nota->notaUm == 1) selected @endif>1 pontos</option>
                                </optgroup>
                                <optgroup label="Não Atendeu">
                                    <option value="0" @if($nota->notaUm == 0) selected @endif>0 pontos</option>
                                </optgroup>                            </select>
                            <label>Uso adequado da metodologia científica</label>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="section">
                    <h5 class="center-align">Relevância Científica e/ou Sociocultura (10 pontos)</h5>

                    <blockquote>
                        O tema do trabalho é relevante para a comunidade e os resultados e/ou conclusões contribuem para
                        o
                        seu
                        desenvolvimento e/ou de seus pesquisadores?
                    </blockquote>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="notaDois">
                                <option value="" disabled selected>Avaliar...</option>
                                <optgroup label="Ótimo">
                                    <option value="10" @if($nota->notaDois == 10) selected @endif>10 pontos</option>
                                </optgroup>
                                <optgroup label="Muito Bom">
                                    <option value="9" @if($nota->notaDois == 9) selected @endif>9 pontos</option>
                                    <option value="8" @if($nota->notaDois == 8) selected @endif>8 pontos</option>
                                </optgroup>
                                <optgroup label="Bom">
                                    <option value="7" @if($nota->notaDois == 7) selected @endif>7 pontos</option>
                                    <option value="6" @if($nota->notaDois == 6) selected @endif>6 pontos</option>
                                </optgroup>
                                <optgroup label="Regular">
                                    <option value="5" @if($nota->notaDois == 5) selected @endif>5 pontos</option>
                                    <option value="4" @if($nota->notaDois == 4) selected @endif>4 pontos</option>
                                </optgroup>
                                <optgroup label="Insuficiente">
                                    <option value="3" @if($nota->notaDois == 3) selected @endif>3 pontos</option>
                                    <option value="2" @if($nota->notaDois == 2) selected @endif>2 pontos</option>
                                    <option value="1" @if($nota->notaDois == 1) selected @endif>1 pontos</option>
                                </optgroup>
                                <optgroup label="Não Atendeu">
                                    <option value="0" @if($nota->notaDois == 0) selected @endif>0 pontos</option>
                                </optgroup>
                            </select>
                            <label>Relevância do projeto</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>

            <div class="section">
                <h5 class="center-align">Registro da pesquisa (20 pontos)</h5>

                <blockquote>
                    O trabalho tem caderno de campo (diário de bordo) e/ou outros registros, como pasta de documentos?
                    Esse(s)
                    material(is) evidenciam a coleta de dados ao longo da pesquisa?
                </blockquote>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="notaTres">
                            <option value="" disabled selected>Avaliar...</option>
                            <optgroup label="Ótimo">
                                <option value="10" @if($nota->notaTres == 10) selected @endif>10 pontos</option>
                            </optgroup>
                            <optgroup label="Muito Bom">
                                <option value="9" @if($nota->notaTres == 9) selected @endif>9 pontos</option>
                                <option value="8" @if($nota->notaTres == 8) selected @endif>8 pontos</option>
                            </optgroup>
                            <optgroup label="Bom">
                                <option value="7" @if($nota->notaTres == 7) selected @endif>7 pontos</option>
                                <option value="6" @if($nota->notaTres == 6) selected @endif>6 pontos</option>
                            </optgroup>
                            <optgroup label="Regular">
                                <option value="5" @if($nota->notaTres == 5) selected @endif>5 pontos</option>
                                <option value="4" @if($nota->notaTres == 4) selected @endif>4 pontos</option>
                            </optgroup>
                            <optgroup label="Insuficiente">
                                <option value="3" @if($nota->notaTres == 3) selected @endif>3 pontos</option>
                                <option value="2" @if($nota->notaTres == 2) selected @endif>2 pontos</option>
                                <option value="1" @if($nota->notaTres == 1) selected @endif>1 pontos</option>
                            </optgroup>
                            <optgroup label="Não Atendeu">
                                <option value="0" @if($nota->notaTres == 0) selected @endif>0 pontos</option>
                            </optgroup>
                        </select>
                        <label>Registros da realização da pesquisa</label>
                    </div>
                </div>
                <blockquote>
                    O resumo expressa adequadamente o trabalho desenvolvido, em linguagem apropriada, e está coerente
                    com a
                    pesquisa apresentada pelo projeto?
                </blockquote>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="notaQuatro">
                            <option value="" disabled selected>Avaliar...</option>
                            <optgroup label="Ótimo">
                                <option value="10" @if($nota->notaQuatro == 10) selected @endif>10 pontos</option>
                            </optgroup>
                            <optgroup label="Muito Bom">
                                <option value="9" @if($nota->notaQuatro == 9) selected @endif>9 pontos</option>
                                <option value="8" @if($nota->notaQuatro == 8) selected @endif>8 pontos</option>
                            </optgroup>
                            <optgroup label="Bom">
                                <option value="7" @if($nota->notaQuatro == 7) selected @endif>7 pontos</option>
                                <option value="6" @if($nota->notaQuatro == 6) selected @endif>6 pontos</option>
                            </optgroup>
                            <optgroup label="Regular">
                                <option value="5" @if($nota->notaQuatro == 5) selected @endif>5 pontos</option>
                                <option value="4" @if($nota->notaQuatro == 4) selected @endif>4 pontos</option>
                            </optgroup>
                            <optgroup label="Insuficiente">
                                <option value="3" @if($nota->notaQuatro == 3) selected @endif>3 pontos</option>
                                <option value="2" @if($nota->notaQuatro == 2) selected @endif>2 pontos</option>
                                <option value="1" @if($nota->notaQuatro == 1) selected @endif>1 pontos</option>
                            </optgroup>
                            <optgroup label="Não Atendeu">
                                <option value="0" @if($nota->notaQuatro == 0) selected @endif>0 pontos</option>
                            </optgroup>
                        </select>
                        <label>Clareza e adequação do resumo</label>
                    </div>
                </div>
            </div>
            <div class="divider"></div>

            <div class="section">
                <h5 class="center-align">Clareza e Habilidade (20 pontos)</h5>

                <blockquote>
                    Os/as alunos/as demonstram segurança e domínio do assunto, no manuseio dos equipamentos e/ou na
                    exposição dos cartazes e folhetos? Eles/as respondem adequadamente aos questionamentos feitos?
                </blockquote>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="notaCinco">
                            <option value="" disabled selected>Avaliar...</option>
                            <optgroup label="Ótimo">
                                <option value="10" @if($nota->notaCinco == 10) selected @endif>10 pontos</option>
                            </optgroup>
                            <optgroup label="Muito Bom">
                                <option value="9" @if($nota->notaCinco == 9) selected @endif>9 pontos</option>
                                <option value="8" @if($nota->notaCinco == 8) selected @endif>8 pontos</option>
                            </optgroup>
                            <optgroup label="Bom">
                                <option value="7" @if($nota->notaCinco == 7) selected @endif>7 pontos</option>
                                <option value="6" @if($nota->notaCinco == 6) selected @endif>6 pontos</option>
                            </optgroup>
                            <optgroup label="Regular">
                                <option value="5" @if($nota->notaCinco == 5) selected @endif>5 pontos</option>
                                <option value="4" @if($nota->notaCinco == 4) selected @endif>4 pontos</option>
                            </optgroup>
                            <optgroup label="Insuficiente">
                                <option value="3" @if($nota->notaCinco == 3) selected @endif>3 pontos</option>
                                <option value="2" @if($nota->notaCinco == 2) selected @endif>2 pontos</option>
                                <option value="1" @if($nota->notaCinco == 1) selected @endif>1 pontos</option>
                            </optgroup>
                            <optgroup label="Não Atendeu">
                                <option value="0" @if($nota->notaCinco == 0) selected @endif>0 pontos</option>
                            </optgroup>
                        </select>
                        <label>Desempenho na apresentação do projeto</label>
                    </div>
                </div>

                <blockquote>
                    Há relação adequada entre a apresentação oral e os registros de pesquisa?
                </blockquote>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="notaSeis">
                            <option value="" disabled selected>Avaliar...</option>
                            <optgroup label="Ótimo">
                                <option value="10" @if($nota->notaSeis == 10) selected @endif>10 pontos</option>
                            </optgroup>
                            <optgroup label="Muito Bom">
                                <option value="9" @if($nota->notaSeis == 9) selected @endif>9 pontos</option>
                                <option value="8" @if($nota->notaSeis == 8) selected @endif>8 pontos</option>
                            </optgroup>
                            <optgroup label="Bom">
                                <option value="7" @if($nota->notaSeis == 7) selected @endif>7 pontos</option>
                                <option value="6" @if($nota->notaSeis == 6) selected @endif>6 pontos</option>
                            </optgroup>
                            <optgroup label="Regular">
                                <option value="5" @if($nota->notaSeis == 5) selected @endif>5 pontos</option>
                                <option value="4" @if($nota->notaSeis == 4) selected @endif>4 pontos</option>
                            </optgroup>
                            <optgroup label="Insuficiente">
                                <option value="3" @if($nota->notaSeis == 3) selected @endif>3 pontos</option>
                                <option value="2" @if($nota->notaSeis == 2) selected @endif>2 pontos</option>
                                <option value="1" @if($nota->notaSeis == 1) selected @endif>1 pontos</option>
                            </optgroup>
                            <optgroup label="Não Atendeu">
                                <option value="0" @if($nota->notaSeis == 0) selected @endif>0 pontos</option>
                            </optgroup>
                        </select>
                        <label>Relação da apresentação oral com o projeto</label>
                    </div>
                </div>
            </div>
            <div class="divider"></div>

            <div class="section">
                <h5 class="center-align">Capacidade Criativa (10 pontos)</h5>

                <blockquote>
                    O estande do projeto encontra-se organizado e limpo? O trabalho exposto apresenta clareza nos textos
                    e
                    criatividade no seu planejamento e/ou execução?
                </blockquote>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="notaSete">
                            <option value="" disabled selected>Avaliar...</option>
                            <optgroup label="Ótimo">
                                <option value="10" @if($nota->notaSete == 10) selected @endif>10 pontos</option>
                            </optgroup>
                            <optgroup label="Muito Bom">
                                <option value="9" @if($nota->notaSete == 9) selected @endif>9 pontos</option>
                                <option value="8" @if($nota->notaSete == 8) selected @endif>8 pontos</option>
                            </optgroup>
                            <optgroup label="Bom">
                                <option value="7" @if($nota->notaSete == 7) selected @endif>7 pontos</option>
                                <option value="6" @if($nota->notaSete == 6) selected @endif>6 pontos</option>
                            </optgroup>
                            <optgroup label="Regular">
                                <option value="5" @if($nota->notaSete == 5) selected @endif>5 pontos</option>
                                <option value="4" @if($nota->notaSete == 4) selected @endif>4 pontos</option>
                            </optgroup>
                            <optgroup label="Insuficiente">
                                <option value="3" @if($nota->notaSete == 3) selected @endif>3 pontos</option>
                                <option value="2" @if($nota->notaSete == 2) selected @endif>2 pontos</option>
                                <option value="1" @if($nota->notaSete == 1) selected @endif>1 pontos</option>
                            </optgroup>
                            <optgroup label="Não Atendeu">
                                <option value="0" @if($nota->notaSete == 0) selected @endif>0 pontos</option>
                            </optgroup>
                        </select>
                        <label>Apresentação visual do estande do
                            projeto</label>
                    </div>
                </div>
            </div>

            <div class="section">
                <h5 class="center-align">Observação (opcional)</h5>

                <blockquote>
                    No campo abaixo você pode opcionalmente escrever uma observação para projeto avaliado.
                </blockquote>
                <div class='row'>
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">assignment</i>
                        <textarea name="observacao" id="textarea1" data-length="480"
                                  class="materialize-textarea">{{$nota->observacoes}}</textarea>
                        <label for="textarea1">Observação</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_projeto" value="{{$projeto->id}}">
            <div class="center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </div>
</form>
@endsection