@extends('layouts.plantilla')
@section('titulo','Sistema Pedidos')

@section('articulo1','Registrarse como nuevo usuario')
@section('articulo2')
<form action="#" method="POST">
    @csrf
  <br>Nombre:<input name="nombre" type="text" required>
  <br>Tipo de Cuenta:<select name="tipoc"><option>Vendedor</option><option>Comprador</option></select>
  <br>Correo Electronico:<input name="email" type="text">
  <br>Contraseña:<input type="password" name="password" id="pass">
  <input type="button" value="Ver" onclick="verPass()">
  <br><input type="submit" value="Registrarse"><br>
  </form>
  <br>¿Olvidaste tu contraseña?<br><a href="{{route('recontra')}}">Recuperar contraseña</a>
  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection