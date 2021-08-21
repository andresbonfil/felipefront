@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Bienvenido comprador:
<?php echo session('alias'); ?>
@endsection
@section('articulo2')
<table border=1>
  <tr><th colspan="5"> Lista de vendedores:</th></tr>
  <tr>
    <th>id</th>
    <th>nombre</th>
    <th>email</th>
    <th>Cotizar</th>      
  </tr>
  @foreach($listavendedores as $lista)
    <tr>
        <td>{{$lista->id}}</td>
        <td>{{$lista->nombre}}</td>
        <td>{{$lista->email}}</td>
        <td><a href="{{route('vervender', $lista->id)}}">$$$$$</a></td>
    </tr>
  @endforeach
  
  </table>

  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection