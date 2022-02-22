@extends('layouts.app')
@section('content')
<h1>Teste de Index</h1>


@foreach($scientists as $scientist)
    <span>{{ $scientist->getFirstname() }} {{ $scientist->getLastName() }} </span><br />
    @foreach($scientist->getTheories() as $theorie)
        <span>- {{$theorie->getTitle() }}<br /></span>
    @endforeach
@endforeach 

{{-- <x-table />
<x-render-thead :items="['id','Nome', 'Rótulo', 'Status', 'Fila Padrão', 'Filas de Espera', 'Filas de Encaminhamento' ]" :acao="$acao" />

@foreach($scientists as $scientist)
  <x-render-tbody 
    :items="[
             ]" 
    :id="$local->id" :acao="$acao" :modelName="$type" />
@endforeach 
<x-table acao="close"/> --}}

@endsection