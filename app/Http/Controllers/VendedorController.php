<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VendedorController extends Controller
{
    public function addproducto(Request $request){
        //return $request;
        
        $respuesta = Http::post('http://127.0.0.1:8000/api/producto', [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'pu' => $request->pu,
            'pe' => $request->pe,
            'cpe' => $request->cpe,
            'disponible' => $request->disponible,
            'idprovedor' => $request->idprovedor
        ]);
        $dato=json_decode($respuesta);
        
        if($dato->estatus=="Aprobado"){   
            $respuesta2 = Http::get('http://127.0.0.1:8000/api/productoprovedor?idprovedor='.session('id'));
            $listaproductos=json_decode($respuesta2);
            return view('vendedor.inicio',compact('dato','listaproductos')); }
        else{return $respuesta;}
    }

    public function verpedidos(){
        $respuesta = Http::get('http://127.0.0.1:8000/api/cotizacion2/'.session('id'));
        $listapedidos=json_decode($respuesta);
        return view('vendedor.pedidos', compact('listapedidos'));
    }

    public function verdetalles($id){
        $respuesta = Http::get('http://127.0.0.1:8000/api/detalle/'.$id);
        $listadetalles=json_decode($respuesta);
        //return $listadetalles;
        return view('vendedor.detalles', compact('listadetalles','id'));
    }
}
