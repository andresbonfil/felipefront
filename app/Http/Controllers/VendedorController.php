<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VendedorController extends Controller
{
    public function addproducto(Request $request){
        
        $respuesta = Http::post('127.0.0.1:8000/api/producto', [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'pu' => $request->pu,
            'pe' => $request->pe,
            'cpe' => $request->cpe,
            'disp' => $request->disp,
            'idv' => $request->idv
        ]);
        $dato=json_decode($respuesta);
        
        if($dato->estatus=="Aprobado"){   
            $respuesta2 = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.session('id'));
            $listaproductos=json_decode($respuesta2);
            return view('vendedor.inicio',compact('listaproductos')); }
        else{return $respuesta;}
    }

    public function delproducto(Request $request){
        Http::delete('127.0.0.1:8000/api/producto/'.$request->id);
        $respuesta2 = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.session('id'));
            $listaproductos=json_decode($respuesta2);
            return view('vendedor.inicio',compact('listaproductos'));
    }
    public function editproducto(Request $request){
        $producto = Http::get('127.0.0.1:8000/api/producto/'.$request->id);
        return view('vendedor.editproducto',compact('producto'));
    }

    public function updateproducto(Request $request){
        $respuesta = Http::put('127.0.0.1:8000/api/producto',[
            'id' => $request->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'pu' => $request->pu,
            'pe' => $request->pe,
            'cpe' => $request->cpe,
            'disp' => $request->disp,
            'idv' => session('id')
        ]);
        $respuesta2 = Http::get('127.0.0.1:8000/api/productoprovedor?idv='.session('id'));
            $listaproductos=json_decode($respuesta2);
            return view('vendedor.inicio',compact('listaproductos'));
    }


    public function verpedidos(){
        $respuesta = Http::get('127.0.0.1:8000/api/cotizacion2/'.session('id'));
        $listapedidos=json_decode($respuesta);
        return view('vendedor.pedidos', compact('listapedidos'));
    }

    public function verdetalles($id){
        $cotizacion = http::get('127.0.0.1:8000/api/cotizacion3/'.$id);
        $comprador=http::get('127.0.0.1:8000/api/usuario/'.$cotizacion[0]['idc']);
        $respuesta = Http::get('127.0.0.1:8000/api/detalle/'.$id);
        $listadetalles=json_decode($respuesta);
        return view('vendedor.detalles', compact('listadetalles','id','comprador'));
    }
}
