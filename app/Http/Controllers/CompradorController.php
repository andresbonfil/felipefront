<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\cotizaEmail;
use Illuminate\Support\Facades\Mail;


class CompradorController extends Controller
{
    public function vervender($id){
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/productoprovedor?idprovedor='.$id);
        //$respuesta=Http::get('http://sistemapedidosback.herokuapp.com/api/venderproductos/'.$id); //otra manera
        $productosvender=json_decode($respuesta);
        $vender = Http::get('http://sistemapedidosback.herokuapp.com/api/usuario/'.$id);

        $respuesta = Http::post('http://sistemapedidosback.herokuapp.com/api/cotizacion', [
            'idc' => session('id'),
            'idv' => $id
        ]);
        $dato=json_decode($respuesta);
        //$dato->folio usar;
        return view('comprador.ver', compact('productosvender','vender','dato')); 
    }

    public function add2detalle(Request $request){
        $importe = json_decode($request->cant)*json_decode($request->precio);
        $respuesta = Http::post('http://sistemapedidosback.herokuapp.com/api/detalle', [
            'cant' => $request->cant,
            'producto' => $request->producto,
            'precio' => $request->precio,
            'importe' => $importe,
            'folio' => $request->folio
        ]);
        //return $respuesta;
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/productoprovedor?idprovedor='.$request->idv);
        $productosvender=json_decode($respuesta);
        $vender = Http::get('http://sistemapedidosback.herokuapp.com/api/usuario/'.$request->idv);
        $detalle2 = Http::get('http://sistemapedidosback.herokuapp.com/api/detalle/'.$request->folio);
        $detalle=json_decode($detalle2);
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/cotizacion');
        $res = json_decode($respuesta);
        $dato=$res[0];
        return view('comprador.ver', compact('productosvender','vender','dato','detalle'));
    }

    public function enviarcotiz(Request $request){
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/detalle/'.$request->folio);
        $detalle = json_decode($respuesta);
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/usuario/'.$request->idprovedor);
        $vendedor = json_decode($respuesta);
        $folio=$request->folio;
        $pdf=\PDF::loadView('pdf.prueba', compact('detalle','vendedor','folio'));
        
        $output = $pdf->output();
                
        $correo=new cotizaEmail($output);

        Mail::to($vendedor->email)->send($correo); 
        Mail::to(session('email'))->send($correo); 
        return $pdf->stream('archivox.pdf');
        
    }

    public function verpedidos(){
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/cotizacion/'.session('id'));
        $listapedidos=json_decode($respuesta);
        return view('comprador.pedidos', compact('listapedidos'));
    }
    public function verdetalles($id){
        $respuesta = Http::get('http://sistemapedidosback.herokuapp.com/api/detalle/'.$id);
        $listadetalles=json_decode($respuesta);
        //return $listadetalles;
        return view('comprador.detalles', compact('listadetalles','id'));
    }
}
