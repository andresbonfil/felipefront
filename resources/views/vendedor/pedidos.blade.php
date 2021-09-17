@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Pedidos de :
<?php echo session('alias'); ?>
@endsection
@section('articulo2')
<table border=1>
  <tr><th colspan="4"> Lista de pedidos:</th></tr>
  <tr>
    <th>folio</th>
    <th>fecha</th>  
    <th>detalle</th> 
  </tr>
  @foreach($listapedidos as $lista)
    <tr>
        <td>{{$lista->id}}</td>
        <td>{{date('d-m-Y', strtotime($lista->created_at));}}</td>
        <td><a href="{{route('detallesvendor', $lista->id)}}">ver</a></td>
    </tr>
  @endforeach
  
  </table>

  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
<form action="{{route('inicioPost')}}" method="post">@csrf <input type="submit" value="regresar"></form>
@endsection