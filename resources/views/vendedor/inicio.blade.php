@extends('layouts.plantilla')
@section('titulo','VENDEDOR')

@section('articulo1')
Binvenido vendedor:
<?php echo session('alias'); ?>
: <a href="{{route('pedidosvendor')}}">pedidos</a>
@endsection
@section('articulo2')
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
        <td>{{$lista->disp}}</td>
        <td>{{$lista->idv}}</td>
        <td>
          <form action="{{route('editproducto')}}" method="get">
          <input type="hidden" name="id" value="{{$lista->id}}">
          <button>edit</button>
          </form>
        </td>
        <td>
          <form action="{{route('delproducto')}}" method="get">
          <input type="hidden" name="id" value="{{$lista->id}}">
          <button>(-)</button>
          </form>
        </td>
    </tr>
    @endforeach  
  </table>
  <br>
  <form action="{{route('addproducto')}}" method="POST"><h1>Agregar nuevo producto:</h1>
    @csrf
  <input type="text" name="nombre" placeholder="Producto nombre" title="Nombre producto" required>
  <textarea name="descripcion" placeholder="descripcion breve del producto" cols="34"></textarea>
  <input type="number" name="pu" placeholder="Precio unitario." title="Precio unitario" step=".5" required>
  <input type="number" name="pe" placeholder="Precio especial." title="Precio especial" step=".5"required> 
  <input type="number" name="cpe" placeholder="Cant. para precio especial" title="Cantidad para precio especial" required>
  <select name="disp"><option value="s">Si</option><option value="n">No</option></select>
  <input type="hidden" name="idv" value="{{session('id')}}">
  <input type="submit" value="Ingresa producto >>">
</form>
  <H1><a href="{{route('logout')}}">CERRAR SESION</a></H1>

  
@endsection

@section('piedepagina')
<a href="#">Mis redes sociales</a>
@endsection