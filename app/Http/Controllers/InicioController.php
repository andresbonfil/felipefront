<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InicioController extends Controller
{
    //FUNCION LOGIN
    public function login (Request $request){
        if(session('alias')==null){
            return view('inicio'); 
        }

        $respuesta = Http::post('https://sistemapedidosback.herokuapp.com/api/usuario/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $dato=json_decode($respuesta);
        
        if($dato->estatus=='Aprobado'){
            
            return 'login exitoso puede redireccionar al panel deseado';
        }
        if($dato->estatus=='Rechazado'){
            return 'la solicitud de incio de sesion fue rechazada';
        }        
        return 'Ocurrio un problema con la petición';
    }


    //ESTA FUNCION RECIBE LA PETICION DE REGISTRARSE RECIBE EL REQUEST DEL FORMULARIO DE REGISTRO
    //Y LE MANDA LOS PARAMETROS AL BACKEND PARA PROBAR QUE NO EXISTA YA UN USUARIO REGISTRADO
    //SI TE REGISTRA O NO TE AVISA Y TE REGRESA UN ENLACE DE RETORNO.
    public function registrarsePost(Request $request){
        $respuesta =
        Http::post('https://sistemapedidosback.herokuapp.com/api/usuario', [
            'txtNombre' => $request->nombre,
            'txtTipoc' => $request->tipoc,
            'txtEmail' => $request->email,
            'txtPassword' => $request->password
        ]);
        $dato=json_decode($respuesta);
        if($dato->estatus=='Aprobado'){
            
            return 'Tu correo electronico: <b>'.$dato->info.'</b> ha sido registrado exitosamente.
            <br>Da click en el enlace para <h1><a href="../">Iniciar Sesión</a></h1>';
        }
        if($dato->estatus=='Rechazado'){
            return '<b>ERROR :</b> El correo electronico: <b>'.$dato->info.'</b><br>
            ya existe en el sistema, intente recuperar su contraseña
            <h1><a href="../">Regresar</a><h1>';
        }        
        return 'Ocurrio un problema con la petición';
    }
    

    //ESTA FUNCION ATIENDE LA PETICION DE RECUPERAR CONTRASEÑA RECIBE EL PARAMETRO
    //DE EMAIL EL CUAL SE LO MANDA AL BACKEND PARA VALIDARLO SI PASA LAS PRUEBAS DEL
    //BACKEND ENVIA INSTRUCCIONES A ESE CORREO CON UN TOKEN SI NO TE AVISA QUE TE REGISTRES
    public function recontraPost(Request $request){
        $respuesta =
        Http::post('https://sistemapedidosback.herokuapp.com/api/usuario/recontra', [
            'txtEmail' => $request->email
        ]);
        $dato=json_decode($respuesta);
        
        if($dato->estatus=='Aprobado'){
            
            return 'Se ha enviado un correo a : <b>'.$dato->info.'</b> sigue las instrucciones.
            <br>Da click en el enlace para <h1><a href="../">Iniciar Sesión</a></h1>';
        }
        if($dato->estatus=='Rechazado'){
            return '<b>ERROR :</b> El correo electronico: <b>'.$dato->info.'</b><br>
            No existe en nuestra base de datos, verifique su informacion.
            <h1><a href="../">Regresar</a><h1>';
        }        
        return 'Ocurrio un problema con la petición';
    }

}
