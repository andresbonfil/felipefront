<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta tu cartilla</title>
</head>
<style>
    .{margin: 10px;}
    body{
        /*background-image: url({{public_path('/images/plantilla.jpg')}});*/
        background-size: 100%;
        background-repeat: no-repeat;
    }
    .datos{
        margin-left:215px;
        margin-top:140px;
    }
    .vacunas{
        margin-left:50px;margin-right:50px;
        margin-top:30px;
    }
    table {
    width: 100%;
    border:1x solid;
    }
    th {
    text-align: center;
    vertical-align: top;
    border: 1px solid #000;
    }
</style>
<body>
<div class="datos">
    <h3>{{$vendedor->nombre}} : {{$vendedor->email}}</h3><br>
</div>
<div class="vacunas">
<?php $totalo=0; ?>
<h1>Esta es tu cotización con folio # : {{$folio}}</h1>
<table border=1>
    <tr><th colspan="5">cotizacio</th></tr>
    <tr>
      <th>cant</th><th>producto</th><th>precio</th><th>importe</th>
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
</div>
    
</body>
</html>