@extends('layouts.plantilla')
@section('titulo','VENDEDOR')

@section('articulo1')
Binvenido vendedor:
<?php echo session('alias'); ?>
: <a href="{{route('pedidosvendor')}}">pedidos</a>
@endsection
@section('articulo2')
  
  <form action="{{route('updateproducto')}}" method="POST"><h1>Editar producto:</h1>
    @csrf
  <input type="text" name="nombre" placeholder="Producto nombre" value="{{$producto['nombre']}}" title="Nombre producto" required>
  <textarea name="descripcion" placeholder="descripcion breve del producto" cols="34">{{$producto['descripcion']}}</textarea>
  <input type="number" name="pu" placeholder="Precio unitario." value="{{$producto['pu']}}" title="Precio unitario" step=".5" required>
  <input type="number" name="pe" placeholder="Precio especial." value="{{$producto['pe']}}" title="Precio especial" step=".5"required> 
  <input type="number" name="cpe" placeholder="Cant. para precio especial" value="{{$producto['cpe']}}" title="Cantidad para precio especial" required>
  <select name="disp">
  <?php 
    if($producto['disp']=="s"){ 
      echo '<option value="s" selected>Sí</option> <option value="n">No</option>';}
    else{ echo '<option value="n" selected>No</option> <option value="s">Sí</option>';}            
  ?>
  </select>
  <input type="hidden" name="id" value="{{$producto['id']}}">
  <input type="submit" value="Actualizar producto >>">
</form>
  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection