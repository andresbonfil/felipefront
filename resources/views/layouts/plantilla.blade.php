<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulo')</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="{{asset('css/plantilla.css')}}">
</head>
<body>
    <nav>
        Sistema de Cotizaciones Bonfil
        <hr>
        <ul>
            <li><a href="">Inicio</a></li>
            <li><a href="">Contactanos</a></li>
            <li><a href="">Acerca de</a></li>
        </ul>
    </nav>    
    <article>
    @yield('articulo1'):<hr>
    @yield('articulo2')
    </article>
    <br>
    <footer>
        CopyRights Todos los Derechos Reservados
        <hr>
        @yield('piedepagina')
    </footer>
</body>
</html>