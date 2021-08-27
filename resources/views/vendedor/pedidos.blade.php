@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Pedidos de :
<?php echo session('alias'); ?>
@endsection
@section('articulo2')
<table border=1>
  <tr><th colspan="5"> Lista de pedidos:</th></tr>
  <tr>
    <th>folio</th>
    <th>fecha</th>  
    <th>detalle</th> 
  </tr>
  @foreach($listapedidos as $lista)
    <tr>
        <td>{{$lista->id}}</td>
        <td>{{$lista->created_at}}</td>
        <td><a href="{{route('detallesvendor', $lista->id)}}">ver</a></td>
    </tr>
  @endforeach
  
  </table>

  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection