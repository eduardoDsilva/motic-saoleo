@extends('_layouts._app')

@section('titulo','Motic Admin')

@section('breadcrumb')
    <a href="{{route ('admin')}}" class="breadcrumb">Home</a>
    <a href="{{route ('admin.avaliador')}}" class="breadcrumb">Avaliador</a>
    <a href="" class="breadcrumb">Vincular avaliador</a>
@endsection

@section('content')

@section('titulo-header', 'Vincular avaliador')

@section('conteudo-header', 'Esses são os projetos disponíveis no sistema para vincular ao avaliador '.$avaliador->name)

@includeIf('_layouts._sub-titulo')

<div class="section container">
    <div class="card-panel">
        <div class="row">
            {{\Illuminate\Support\Facades\Session::put('id', $avaliador->id)}}
            <div class="input-field col s12 m12 l12">
                <select name="projeto" id="projeto" required>
                    <option value="" disabled selected>Categoria...</option>
                    @forelse($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                    @empty
                        <option>Sem projetos dessa categoria</option>
                    @endforelse
                </select>
                <label>Categorias</label>
            </div>
            <form method="post" action="{{route ('admin.avaliador.vincula-projetos')}}">
                {{csrf_field()}}
                <div class="input-field col s11 m11 l11">
                    <select name="projeto" id="projetos" required>
                        <option value="" disabled selected>Projetos...</option>
                    </select>
                    <label>Projetos</label>
                </div>
                <div class="input-field col s1 m1 l1">
                    <button type="submit" class="btn-floating tooltipped" data-position="top" data-delay="50"
                            data-tooltip="Vincular esse projeto ao avaliador"><i class="material-icons">autorenew</i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
