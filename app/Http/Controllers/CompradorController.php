<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompradorController extends Controller
{
    public function vervender($id){
        $respuesta = Http::get('http://127.0.0.1:8000/api/productoprovedor?idprovedor='.$id);
        //$respuesta=Http::get('http://127.0.0.1:8000/api/venderproductos/'.$id); //otra manera
        $productosvender=json_decode($respuesta);
        $vender = Http::get('http://127.0.0.1:8000/api/usuario/'.$id);

        $respuesta = Http::post('http://127.0.0.1:8000/api/cotizacion', [
            'idc' => session('id'),
            'idv' => $id
        ]);
        $dato=json_decode($respuesta);
        //$dato->folio usar;
        return view('comprador.ver', compact('productosvender','vender','dato')); 
    }

    public function add2detalle(Request $request){
        $importe = json_decode($request->cant)*json_decode($request->precio);
        $respuesta = Http::post('http://127.0.0.1:8000/api/detalle', [
            'cant' => $request->cant,
            'producto' => $request->producto,
            'precio' => $request->precio,
            'importe' => $importe,
            'folio' => $request->folio
        ]);
        //return $respuesta;
        $respuesta = Http::get('http://127.0.0.1:8000/api/productoprovedor?idprovedor='.$request->idv);
        $productosvender=json_decode($respuesta);
        $vender = Http::get('http://127.0.0.1:8000/api/usuario/'.$request->idv);
        $detalle2 = Http::get('http://127.0.0.1:8000/api/detalle/'.$request->folio);
        $detalle=json_decode($detalle2);
        $respuesta = Http::get('http://127.0.0.1:8000/api/cotizacion');
        $res = json_decode($respuesta);
        $dato=$res[0];
        return view('comprador.ver', compact('productosvender','vender','dato','detalle'));
    }
}
