@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1','Bienvenido: comprador')
@section('articulo2')
<form action="#" method="POST">
    @csrf
  <br>vIENBENIdO:<input name="nombre" type="text" required>
  <br>SELECCIONES UN PROVEEDOR PARA COTIZAR:<select name="tipoc"><option>Vendedor</option><option>Comprador</option></select>

  </form>
  <br>ES UTED UN COMPRADOR</a>
  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection