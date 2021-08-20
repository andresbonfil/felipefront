@extends('layouts.plantilla')
@section('titulo','Sistema Pedidos')

@section('articulo1','Iniciar Sesión')
@section('articulo2')
<<<<<<< HEAD
  <form action="{{route('loginPost')}}" metod="POST">
=======
  <form action="{{route('inicioPost')}}" method="POST">
  @csrf
>>>>>>> 49766a00134158ddca5fff8198d9f4e13d958564
  <br>Correo Electronico:<input name="email" type="text">
  <br>Contraseña:<input type="password" name="password"id="pass">
  <input type="button" value="Ver" onclick="verPass()">
  <br><input type="submit" value="Ingresar"><br>
  </form>
  <br>¿Eres nuevo?<a href="{{route('registrarse')}}">Registrate</a>
  <br>¿Olvidaste tu contraseña?<br><a href="{{route('recontra')}}">Recuperar contraseña</a><br>
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales ;)</a>
@endsection
