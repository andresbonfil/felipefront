<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InicioController extends Controller
{
    public function __invoke(){ 
        //if(session('alias')==null){
        //    return view('inicio');
        //}
        if(session('tipoc')=='Comprador'){ return view('comprador.inicio'); }
        if(session('tipoc')=='Vendedor') { return view('vendedor.inicio'); }
    }


    //FUNCION LOGIN
    public function inicioPost (Request $request){
        if(session('alias')==null){       
            $respuesta = Http::post('http://127.0.0.1:8000/api/usuario/login', [
                'email' => $request->email,
                'password' => $request->password
            ]);
            $dato=json_decode($respuesta);            
            if($dato->estatus=='Aprobado'){
                session(['id' => $dato->id]);
                session(['alias' => $dato->alias]);
                session(['tipoc' => $dato->tipoc]);
                session(['email' => $dato->email]);               
                if($dato->tipoc=='Comprador'){ 
                    $respuesta2 = Http::get('http://127.0.0.1:8000/api/vendedor');
                    $listavendedores=json_decode($respuesta2);
                    return view('comprador.inicio', compact('listavendedores')); 
                }
                if($dato->tipoc=='Vendedor'){ 
                    $respuesta2 = Http::get('http://127.0.0.1:8000/api/productoprovedor?idprovedor='.$dato->id);
                    $listaproductos=json_decode($respuesta2);
                    return view('vendedor.inicio', compact('listaproductos'));
                }
            }
            if($dato->estatus=='Rechazado'){
                return 'la solicitud de incio de sesion fue rechazada
                <br>Da click en el enlace para <h1><a href="../">Regresar</a></h1>';
            }
        }

        else{
            if(session('tipoc')=='Comprador'){
                $respuesta2 = Http::get('http://127.0.0.1:8000/api/vendedor');
                $listavendedores=json_decode($respuesta2);
                return view('comprador.inicio', compact('listavendedores')); 
            }
            if(session('tipoc')=='Vendedor'){ 
                $respuesta2 = Http::get('http://127.0.0.1:8000/api/productoprovedor?idprovedor='.session('id'));
                $listaproductos=json_decode($respuesta2);
                return view('vendedor.inicio', compact('listaproductos')); }
        }     
        return 'algo salio mal';
    }


    //ESTA FUNCION RECIBE LA PETICION DE REGISTRARSE RECIBE EL REQUEST DEL FORMULARIO DE REGISTRO
    //Y LE MANDA LOS PARAMETROS AL BACKEND PARA PROBAR QUE NO EXISTA YA UN USUARIO REGISTRADO
    //SI TE REGISTRA O NO TE AVISA Y TE REGRESA UN ENLACE DE RETORNO.
    public function registrarsePost(Request $request){
        $respuesta =
        Http::post('http://127.0.0.1:8000/api/usuario', [
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
        Http::post('http://127.0.0.1:8000/api/usuario/recontra', [
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

    public function logout(){ Session::flush(); return redirect()->route('inicio'); }

}
