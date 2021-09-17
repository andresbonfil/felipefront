@extends('layouts.plantilla')
@section('titulo','Sistema Pedidos')

@section('articulo1')
{{session('alias') ?? 'Iniciar sesion'}}
@endsection
@section('articulo2')
  <form action="{{route('inicioPost')}}" method="POST">
  @csrf
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
