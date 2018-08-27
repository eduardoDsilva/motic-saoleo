@extends('_layouts._app')

@section('titulo','Erro')

@section('breadcrumb')
    <a href="" class="breadcrumb">Home</a>
@endsection

@section('content')
    <div class="container">
        <h2>Código de erro: {{$exception->getMessage()}}</h2>
        <h3>Entre em contato com a administração da MOTIC informando este código. Desculpem-nos o incômodo.</h3>
        <a class="waves-effect waves-light btn" href="{{redirect()->back()}}"><i class="material-icons left">cloud</i>Voltar</a>
    </div>
@endsection
