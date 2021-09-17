<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cotización</title>
</head>
<style>
    .{margin: 10px;}
    body{
        /*background-image: url({{public_path('/images/plantilla.jpg')}});*/
        background-size: 100%;
        background-repeat: no-repeat;
    }
    table {
    width: 100%;
    border:1x solid;
    }
    th {
    text-align: center;
    background-color:gray;
    vertical-align: top;
    border: 1px solid #000;
    }
    p{
        margin-left:25%;
        margin-right:25%;
    }
</style>
<body>
<div>
<?php $totalo=0; ?>
<h1>Sistema de Pedidos .:Bonfil:.</h1>
<table>
    <tr><th colspan="4">Cotización con Folio # {{$folio}}</th></tr>
    <tr><th colspan="2">Fecha: <?php $date = new DateTime(); 
    $date->setTimeZone(new DateTimeZone("America/Mexico_City")); echo $date->format('Y-m-d'); ?> </th><th> Hora: <?php echo $date->format('H:i:s'); ?></th>
    <th>Vecimiento: <?php 
        $nuevafecha = strtotime ( '+20 day' , strtotime ( $date->format('Y-m-d') ) ) ;
        echo date ( 'Y-m-d' , $nuevafecha ); 
    ?></th></tr>
    <tr><td>Vendedor : </td><td><b>{{$vendedor->nombre}}</b></td><td>correo-e :</td><td>{{$vendedor->email}}</td></tr>
    <tr><td>Comprador : </td><td><b>{{$comprador->nombre}}</b></td><td>correo-e :</td><td>{{$comprador->email}}</td></tr>
    
</table>
<table>
    <tr><th colspan="4">Nota de cotización</th></tr>
    <tr>
      <th>cant</th><th>producto</th><th>precio</th><th>importe</th>
    </tr>
    @isset($detalle)
    
        @foreach($detalle as $list)
        <tr>
            <td>{{$list->cant}}</td>
            <td>{{$list->producto}}</td>
            <td>${{$list->precio}}</td>
            <td>${{$list->importe}}</td>
        </tr>
        <?php $totalo+=$list->importe ?>
         @endforeach
    @endisset  
    <tr>
        <td>*</td><td>***** Esta nota caduca en 20 dias *****</td>
        <td>T O T A L == </td><td><b>$<?php echo $totalo; ?></b></td>
    </tr>   
  </table>
 <p>Estimado comprador, le informamos que ud. cuenta con 20 días a partir de esta fecha
  para realizar cambios en su cotización, pasada esa fecha ya no podrá hacer ningun cambio.</p>
</div>
    
</body>
</html>