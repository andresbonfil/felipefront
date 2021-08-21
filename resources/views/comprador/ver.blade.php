<?php $totalo=0; ?>
@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Bienvenido comprador:
<?php if(isset(session('alias')){
      echo session('alias') ); }?>
@endsection
@section('articulo2')
<table border=1>
    <tr><th colspan="9">Productos de - [ {{$vender['nombre']}} ] - FOLIO: {{$dato->folio ?? $dato->id}}</th></tr>
    <tr>
      <th>nombre</th><th>descripcion</th><th>pu</th><th>pe</th><th>cpe</th>
      <th>dis</th><th>cant</th><th>agregar</th>
    </tr>
  @foreach($productosvender as $lista)
    <tr><form action="{{route('add2detalle')}}" method="POST"> @csrf
        <td>{{$lista->nombre}}</td>
        <td>{{$lista->descripcion}}</td>
        <td>{{$lista->pu}}</td>
        <td>{{$lista->pe}}</td>
        <td>{{$lista->cpe}}</td>
        <td>{{$lista->disponible}}</td>
        <td>
            <input name="cant" type="number" size="3" min="1" onchange="multiplicar()">
            <input name="producto" type="hidden" value="{{$lista->nombre}}">
            <input name="precio" type="hidden" value="{{$lista->pu}}">
            <input name="folio" type="hidden" value="{{$dato->folio ?? $dato->id}}">
            <input name="idv" type="hidden" value="{{$lista->idprovedor}}">
        </td>
        <td><input type="submit" value="agregar"></td>
    </form></tr>
  @endforeach
  
  </table>

<br>

<table border=1>
    <tr><th colspan="5">remision</th></tr>
    <tr>
      <th>cant.</th><th>producto</th><th>pu</th><th>importe</th>
    </tr>
    @isset($detalle)
    
        @foreach($detalle as $list)
        <tr>
            <td>{{$list->cant}}</td>
            <td>{{$list->producto}}</td>
            <td>{{$list->precio}}</td>
            <td>{{$list->importe}}</td>
        </tr>
        <?php $totalo+=$list->importe ?>
         @endforeach
    @endisset  
    <tr>
        <td>*</td><td>*********</td><td colspan='2'>total $<?php echo $totalo; ?></td>
    </tr> 
  
  </table>


@endsection
 
@section('piedepagina')
<a href="#">Mis redes sociales</a>
<form action="{{route('inicioPost')}}" method="post">@csrf <input type="submit" value="regresar"></form> 
@endsection
<script>

function multiplicar(){
	var _precio=document.getElementById("precio");
	var _cantidad=document.getElementById("cant");
	var _importe=document.getElementById("importe");
	_importe.value=_precio.value*_cantidad.value;
}
</script>