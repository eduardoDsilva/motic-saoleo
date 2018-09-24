@extends('_layouts._app')

@section('titulo','Motic')

@section('breadcrumb')
    <a href="{{{route ('home')}}}" class="breadcrumb">Home</a>
@endsection

@section('content')
<div class="white">
    <img class="responsive-img" src="{{url('images/motic-home.png')}}">
</div>
@endsection