<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\cotizaEmail;
use App\Mail\aviso;
use Illuminate\Support\Facades\Mail;


class CompradorController extends Controller
{
    public function vervender($id){
        $respuesta = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.$id);
        $productosvendedor=json_decode($respuesta);

        $datosvendedor = Http::get('127.0.0.1:8000/api/usuario/'.$id);
        $respuesta = Http::get('127.0.0.1:8000/api/cotizacion');
        $folio= $respuesta[0]['id']+1;
        return view('comprador.ver', compact('productosvendedor','datosvendedor','folio'));
    }
//------------------------------------------------------------------------------------------------
    public function add2detalle(Request $request){
        $respuesta = Http::get('127.0.0.1:8000/api/cotizacion');
        if(($respuesta[0]['id']+1)==$request->folio){
        Http::post('127.0.0.1:8000/api/cotizacion', [
            'idc' => session('id'),
            'idv' => $request->idv
        ]);
        }

       if(json_decode($request->cant) >= json_decode($request->cpe)){
           $precio=json_decode($request->pe);
       }else{ $precio=json_decode($request->pu); }
        $importe = json_decode($request->cant)*$precio;
        $respuesta = Http::post('127.0.0.1:8000/api/detalle', [
            'cant' => $request->cant,
            'producto' => $request->producto,
            'precio' => $precio,
            'importe' => $importe,
            'folio' => $request->folio
        ]);

        $respuesta = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.$request->idv);
        $productosvendedor=json_decode($respuesta);
        $datosvendedor = Http::get('127.0.0.1:8000/api/usuario/'.$request->idv);
        $respuesta = Http::get('127.0.0.1:8000/api/detalle/'.$request->folio);
        $detalle=json_decode($respuesta);
        $folio=$request->folio;
        return view('comprador.ver', compact('productosvendedor','datosvendedor','folio','detalle'));
    }
//----------------------------------------------------------------------------------------------
public function deldetalle(Request $request){
    Http::delete('127.0.0.1:8000/api/detalle/'.$request->id);

    $respuesta = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.$request->idv);
    $productosvendedor=json_decode($respuesta);
    $datosvendedor = Http::get('127.0.0.1:8000/api/usuario/'.$request->idv);
    $respuesta = Http::get('127.0.0.1:8000/api/detalle/'.$request->folio);
    $detalle=json_decode($respuesta);
    $folio=$request->folio;
    return view('comprador.ver', compact('productosvendedor','datosvendedor','folio','detalle'));
}

public function delpedido(Request $request){
    $cotizacion = Http::get('127.0.0.1:8000/api/cotizacion3/'.$request->id);
    $comprador= http::get('127.0.0.1:8000/api/usuario/'.$cotizacion[0]['idc']);
    $vendedor= http::get('127.0.0.1:8000/api/usuario/'.$cotizacion[0]['idv']);
    $data=['nombre'=>$comprador['nombre'], 'email'=>$comprador['email'] ];
    $correo=new aviso($data);
    Mail::to($vendedor['email'])->send($correo);

    Http::delete('127.0.0.1:8000/api/cotizacion/'.$request->id);
    $respuesta = Http::get('127.0.0.1:8000/api/cotizacion/'.session('id'));
    $listapedidos=json_decode($respuesta);
    return view('comprador.pedidos', compact('listapedidos'));
}
//----------------------------------------------------------------------------------------------
    public function enviarcotiz(Request $request){
        $respuesta = Http::get('127.0.0.1:8000/api/detalle/'.$request->folio);
        $detalle = json_decode($respuesta);
        $respuesta = Http::get('127.0.0.1:8000/api/usuario/'.$request->idv);
        $vendedor = json_decode($respuesta);
        $respuesta = Http::get('127.0.0.1:8000/api/usuario/'.session('id'));
        $comprador = json_decode($respuesta);
        $folio=$request->folio;
        $pdf=\PDF::loadView('pdf.prueba', compact('detalle','vendedor','comprador','folio'));
        $output = $pdf->output();
        $correo=new cotizaEmail($output);
        Mail::to($vendedor->email)->send($correo); 
        Mail::to(session('email'))->send($correo); 
        return $pdf->stream('archivox.pdf');
        
    }

    public function verpedidos(){
        $respuesta = Http::get('127.0.0.1:8000/api/cotizacion/'.session('id'));
        $listapedidos=json_decode($respuesta);
        //return $listapedidos;
        return view('comprador.pedidos', compact('listapedidos'));
    }
    public function verdetalles($id){
        $cotizacion = http::get('127.0.0.1:8000/api/cotizacion3/'.$id);
        $vendedor=http::get('127.0.0.1:8000/api/usuario/'.$cotizacion[0]['idv']);
        $respuesta = Http::get('127.0.0.1:8000/api/detalle/'.$id);
        $listadetalles=json_decode($respuesta);
        //return $listadetalles;
        return view('comprador.detalles', compact('listadetalles','id','vendedor'));
    }
}
