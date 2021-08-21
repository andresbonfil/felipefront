@extends('layouts.plantilla')
@section('titulo','VENDEDOR')

@section('articulo1')
Binvenido vendedor:
<?php echo session('alias'); ?>
@endsection
@section('articulo2')
{{$dato->estatus ?? ''}} {{$dato->info ?? ''}}
<form action="addproducto" method="POST">
    @csrf
  <input type="text" name="nombre" placeholder="Producto" title="Nombre producto">
  <textarea name="descripcion" placeholder="descripcion breve del producto" cols="34"></textarea>
  <input type="number" name="pu" placeholder="Precio unitario." title="Precio unitario" step=".5">
  <input type="number" name="pe" placeholder="Precio especial." title="Precio especial" step=".5"> 
  <input type="number" name="cpe" placeholder="Cant. para precio especial" title="Cantidad para precio especial">
  <select name="disponible" title="Disponible"><option value="s">Si</option><option value="n">No</option></select>
  <input type="hidden" name="idprovedor" value="{{session('id')}}">
  <input type="submit" value="Ingresa producto >>">
</form>

  <table border=1>
    <tr>
      <th>id</th>
      <th>nombre</th><th>descripcion</th><th>pu</th><th>pe</th><th>cpe</th><th>disponible</th>
      <th>idprovedor</th><th>editar</th><th>eliminar</th>
    </tr>
    @foreach($listaproductos as $lista)
    <tr>
        <td>{{$lista->id}}</td>
        <td>{{$lista->nombre}}</td>
        <td>{{$lista->descripcion}}</td>
        <td>{{$lista->pu}}</td>
        <td>{{$lista->pe}}</td>
        <td>{{$lista->cpe}}</td>
        <td>{{$lista->disponible}}</td>
        <td>{{$lista->idprovedor}}</td>
        <td><a href="#">Editar</a></td>
        <td><a href="#">Eliminar</a></td>
    </tr>
    @endforeach
  
  </table>
  <br>
  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection