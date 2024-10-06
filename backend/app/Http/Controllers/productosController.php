<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class productosController extends Controller
{
    //MÉTODO GET PARA PRODUCTOS
    public function getProductos(){
        $productos=Productos::all();

        if($productos->isEmpty()){
            $data=[
                "message"=>"No se encontró ningún producto",
                "status"=>404,
            ];
            return response()->json($data,404);
        }
        $data=[
            "message"=>"Productos encontrados correctamente",
            "data"=>$productos,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    //METODO POST DE PRODUCTOS
    public function postProductos(Request $request){
        Log::info($request->all());
        $validate=Validator::make($request->all(),[
            "nombre"=>"required|max:50",
            "descripcion"=>"required|max:100",
        ]);
        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error con los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }
        if($request->estado==null){
            $request->merge(["estado"=>true]);
        }
        $productos=Productos::create([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "estado"=>$request->estado,
        ]);
        if(!$productos){
            $data=[
                "message"=>"Hubo un error en crear el producto",
                "status"=>500,
            ];
            return response()->json($data,500);
        }

        $data=[
            "message"=>"Producto creado correctamente",
            "data"=>$productos,
            "status"=>201
        ];
        return response()->json($data,201);

    }
}
