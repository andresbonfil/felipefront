<?php $totalo=0; ?>
@extends('layouts.plantilla')
@section('titulo','COMPRADOR')

@section('articulo1')
Bienvenido comprador:
<?php echo session('alias'); ?>
@endsection
@section('articulo2')
<table border=1>
    <tr><th colspan="9">Productos de : [ {{$datosvendedor['nombre']}} :: {{$datosvendedor['email']}} ]</th></tr>
    <tr>
      <th>nombre</th><th>descripcion</th><th>pu</th><th>pe</th><th>cpe</th>
      <th>disp</th><th>cant</th><th>agregar</th>
    </tr>
  @isset($productosvendedor)
  @foreach($productosvendedor as $lista)
    <tr><form action="{{route('add2detalle')}}" method="POST"> @csrf
        <td>{{$lista->nombre}}</td>
        <td>{{$lista->descripcion}}</td>
        <td>{{$lista->pu}}</td>
        <td>{{$lista->pe}}</td>
        <td>{{$lista->cpe}}</td>
        <td>{{$lista->disp}}</td>
        <td>
            <input name="cant" type="number" size="3" min="1" required>
            <input name="producto" type="hidden" value="{{$lista->nombre}}">
            <input name="pu" type="hidden" value="{{$lista->pu}}">
            <input name="pe" type="hidden" value="{{$lista->pe}}">
            <input name="cpe" type="hidden" value="{{$lista->cpe}}">
            <input name="folio" type="hidden" value="{{$folio}}">
            <input name="idv" type="hidden" value="{{$lista->idv}}">
        </td>
        <td><input type="submit" value="agregar"></td>
    </form></tr>
  @endforeach
  @endisset
  
  </table>

<br>

<table border=1>
    <tr><th colspan="5">NOTA REMISION - - FOLIO NO. {{$folio}}</th></tr>
    <tr>
      <th>cant</th><th>producto</th><th>precio</th><th>importe</th><th>quitar</th>
    </tr>
    @isset($detalle)
    
        @foreach($detalle as $list)
        <tr>
            <td>{{$list->cant}}</td>
            <td>{{$list->producto}}</td>
            <td>{{$list->precio}}</td>
            <td>{{$list->importe}}</td>
            <td><form action="{{route('deldetalle')}}" method="get">
            <input type="hidden" name="id" value="{{$list->id}}">
            <input type="hidden" name="folio" value="{{$folio}}">
            <input type="hidden" name="idv" value="{{$datosvendedor['id']}}">
            <button>(-)</button>
            </form></td>
        </tr>
        <?php $totalo+=$list->importe ?>
         @endforeach
    @endisset  
    <tr>
        <td>*</td><td colspan='2'>*********</td><td colspan='2'><b>TOTAL $<?php echo $totalo; ?></b></td>
    </tr> 
    <tr>
        <td colspan="5">Enviar esta cotización:
        <form action="{{route('enviarcotiz')}}" method="get">
        <input type="hidden" name="folio" value="{{$folio}}">
        <input type="hidden" name="idv" value="{{$datosvendedor['id']}}">
        <input type="submit" value="Generar pedido">
        </form></td>
    </tr>
  
  </table>

@endsection
 
@section('piedepagina')
<a href="#">Mis redes sociales</a>
<form action="{{route('inicioPost')}}" method="post">@csrf <input type="submit" value="regresar"></form> 
@endsection
