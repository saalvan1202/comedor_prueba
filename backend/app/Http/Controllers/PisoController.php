<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PisoController extends Controller
{
    public function getPisos(){
        $pisos = collect(Piso::all())->filter(function($value){
            return $value["estado"]==true;
        });

        if($pisos->isEmpty()){
            $data=[
                "message"=>"No se encontró ningún piso",
                "status"=>204,
                "data"=>[]
            ];
            return response()->json($data,200);
        }

        $data=[
            "message"=>"Pisos encontrados correctamente",
            "data"=>$pisos,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function findPiso($id){
        $piso = Piso::find($id);

        if(!$piso){
            $data=[
                "message"=>"El piso con el id no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $data=[
            "message"=>"Piso encontrado correctamente",
            "data"=>$piso,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function postPiso(Request $request){
        Log::info($request->all());

        $validate=Validator::make($request->all(),[
            "nombre"=>"string|required|max:100",
            "descripcion"=>"string|required|max:255",
            "estado"=>"boolean",
        ]);

        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error con los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $request->merge(["estado"=>$request->input("estado",true)]);

        $pisos = Piso::create([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "estado"=>$request->estado,
        ]);

        if(!$pisos){
            $data=[
                "message"=>"Hubo un error en crear el piso",
                "status"=>500,
            ];
            return response()->json($data,500);
        }

        $data=[
            "message"=>"Producto creado correctamente",
            "data"=>$pisos,
            "status"=>201
        ];
        return response()->json($data,201);
    }

    public function putPiso(Request $request,$id){
        $piso = Piso::find($id);

        if(!$piso){
            $data=[
                "message"=>"El piso no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $validate=Validator::make($request->all(),[
            "nombre"=>"string|required|max:100",
            "descripcion"=>"string|required|max:255",
            "estado"=>"boolean|required",
        ]);

        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error en los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $piso->nombre=$request->nombre;
        $piso->descripcion=$request->descripcion;
        $piso->estado=$request->estado;

        $piso->save();

        $data=[
            "message"=>"Piso editado correctamente",
            "data"=>$piso,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function patchPiso(Request $request,$id){
        $piso = Piso::find($id);

        if(!$piso){
            $data=[
                "message"=>"El piso no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $validate=Validator::make($request->all(),[
            "nombre"=>"max:50",
            "descripcion"=>"max:100",
            "estado"=>"boolean",
        ]);

        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error con los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        if($request->has("nombre")){
            $piso->nombre=$request->nombre;
        }

        if($request->has("descripcion")){
            $piso->descripcion=$request->descripcion;
        }

        if($request->has("estado")){
            $piso->estado=$request->estado;
        }

        $piso->save();

        $data=[
            "message"=>"Campo fue editado correctamente",
            "data"=>$piso,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function deletePiso($id){
        $piso = Piso::find($id);

        if(!$piso){
            $data=[
                "message"=>"El piso a eliminar no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $piso->estado=false;

        $piso->save();

        $data=[
            "message"=>"Producto eliminado correctamente",
            "data"=>$piso,
            "status"=>200,
        ];
        return response()->json($data,200);
    }
}
