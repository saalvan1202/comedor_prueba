<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SalaController extends Controller
{
    public function getSalas(){
        $salas = collect(Sala::all())->filter(function($value){
            return $value["estado"]==true;
        });

        if($salas->isEmpty()){
            $data=[
                "message"=>"No se encontró ninguna sala",
                "status"=>204,
                "data"=>[]
            ];
            return response()->json($data,200);
        }

        $data=[
            "message"=>"Salas encontradas correctamente",
            "data"=>$salas,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function findSala($id){
        $sala = Sala::find($id);

        if(!$sala){
            $data=[
                "message"=>"La sala con el id no fue encontrada",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $data=[
            "message"=>"Sala encontrada correctamente",
            "data"=>$sala,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function postSala(Request $request){
        Log::info($request->all());

        $validate=Validator::make($request->all(),[
            "nombre"=>"string|required|max:50",
            "descripcion"=>"string|required|max:255",
            "tipo_sala"=>"string|required|max:20",
            "aforo"=>"integer|required",
            "estado"=>"boolean",
            "id_piso"=>"integer|required",
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

        $sala = Sala::create([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "tipo_sala"=>$request->tipo_sala,
            "aforo"=>$request->aforo,
            "estado"=>$request->estado,
            "id_piso"=>$request->id_piso,
        ]);

        if(!$sala){
            $data=[
                "message"=>"Hubo un error al crear la sala",
                "status"=>500,
            ];
            return response()->json($data,500);
        }

        $data=[
            "message"=>"Sala creada correctamente",
            "data"=>$sala,
            "status"=>201
        ];
        return response()->json($data,201);
    }

    public function putSala(Request $request,$id){
        $sala = Sala::find($id);

        if(!$sala){
            $data=[
                "message"=>"La sala no fue encontrada",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $validate=Validator::make($request->all(),[
            "nombre"=>"string|required|max:50",
            "descripcion"=>"string|required|max:255",
            "tipo_sala"=>"string|required|max:20",
            "aforo"=>"integer|required",
            "estado"=>"boolean|required",
            "id_piso"=>"integer|required",
        ]);

        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error en los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $sala->nombre=$request->nombre;
        $sala->descripcion=$request->descripcion;
        $sala->tipo_sala=$request->tipo_sala;
        $sala->aforo=$request->aforo;
        $sala->estado=$request->estado;
        $sala->id_piso=$request->id_piso;

        $sala->save();

        $data=[
            "message"=>"Sala editada correctamente",
            "data"=>$sala,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function patchSala(Request $request,$id)
    {
        $sala = Sala::find($id);

        if (!$sala) {
            $data = [
                "message" => "La sala no fue encontrada",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        $validate = Validator::make($request->all(), [
            "nombre" => "max:50",
            "descripcion" => "max:255",
            "tipo_sala" => "max:20",
            "aforo" => "integer",
            "estado" => "boolean",
            "id_piso" => "integer",
        ]);

        if ($validate->fails()) {
            $data = [
                "message" => "Hubo un error con los datos ingresados",
                "error" => $validate->errors(),
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        if ($request->has("nombre")) {
            $sala->nombre = $request->nombre;
        }

        if ($request->has("descripcion")) {
            $sala->descripcion = $request->descripcion;
        }

        if ($request->has("tipo_sala")) {
            $sala->tipo_sala = $request->tipo_sala;
        }

        if ($request->has("aforo")) {
            $sala->aforo = $request->aforo;
        }

        if ($request->has("estado")) {
            $sala->estado = $request->estado;
        }

        if ($request->has("id_piso")) {
            $sala->id_piso = $request->id_piso;
        }

        $sala->save();

        $data=[
            "message"=>"Campo fue editado correctamente",
            "data"=>$sala,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    public function deletePiso($id){
        $sala = Sala::find($id);

        if(!$sala){
            $data=[
                "message"=>"La sala a eliminar no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $sala->estado=false;

        $sala->save();

        $data=[
            "message"=>"Sala eliminada correctamente",
            "data"=>$sala,
            "status"=>200,
        ];
        return response()->json($data,200);
    }
}
