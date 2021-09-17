<?php $totalo=0; ?>
@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Detalle de pedido # : {{$id}} de :
<?php echo session('alias'); ?>
:<a href="{{route('pedidos')}}">pedidos</a>
@endsection
@section('articulo2')
<table border=1>
  <tr><th colspan="4"> FOLIO # : {{$id}}</th></tr>
  <tr>
    <th>cant.</th>
    <th>producto</th>  
    <th>precio</th> 
    <th>importe</th> 
  </tr>
  @foreach($listadetalles as $lista)
    <tr>
        <td>{{$lista->cant}}</td>
        <td>{{$lista->producto}}</td>
        <td>{{$lista->precio}}</td>
        <td>{{$lista->importe}}</td>
    </tr>
    <?php $totalo+=$lista->importe ?>
  @endforeach
  <tr>
        <td>*</td><td colspan='2'>*********</td><td colspan='2'><b>TOTAL $<?php echo $totalo; ?></b></td>
  </tr> 
  <tr><td colspan="4">Quien vende :: {{$vendedor['nombre']}}</td></tr>
  <tr><td colspan="4">Correo de contacto :: {{$vendedor['email']}}</td></tr>
  </table>

  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection