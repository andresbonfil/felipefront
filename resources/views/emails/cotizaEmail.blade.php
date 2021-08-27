<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
</head>
<!--ESTE ES LA VISTA PLANTILLA (recontraEmail.blade.php) DE RECUPERACION DE CONTRASEÑA 
ESTA PLANTILLA SIRVE PARA QUE SEA ENVIADA POR EL MAILER recontraEmail.php AQUI SE CARGAN
LOS DATOS NOMBRE EMAIL Y EL TOKEN CODERAND SE ANEXA UN VINCULO DIRECTO AL BACKEND PARA
PROPORCIONARLE EL TOKEN GENERADO SIN EL CUAL NO ADMITIRÁ MODIFICACIONES-->
<body>
<h1>Te enviamos la cotización #: </h1>
<table border=1>
    <tr><th colspan="5">cotización</th></tr>
    <tr>
      <th>cant</th><th>producto</th><th>precio</th><th>importe</th>
    </tr>
    <tr>
        <td>*</td><td>No pudimos agregar aqui los datos</td><td colspan='2'>total $</td>
    </tr>   
  </table>
<h1>GRACIAS POR COMPRAR CON NOSOTROS</h1>
<img src="http://uxproyect.000webhostapp.com/img/demo.jpg" alt="Pc Life Systems logo"
style="width:300px">
</body>
</html>