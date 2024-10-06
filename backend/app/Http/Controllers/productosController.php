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
        //Creamos una colleción para adquirir nuevos métodos como el filter y entre otros
        #De esa manera útilizamos el filter para que en la consulta se vean solo los estados true
        $productos=collect(Productos::all())->filter(function($value){
           return $value["estado"]==true; 
        });

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
        //Con merge acaparamos el campo estado del request y si es nulo, se pasa a tru, pero si tiene un valor se qeuda con ello.
      $request->merge(["estado"=>$request->input("estado",true)]);
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
    //METODO GET POR ID
    public function findProductos($id){
        $producto=Productos::find($id);

        if(!$producto){
            $data=[
                "message"=>"El producto con el id no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }
        $data=[
            "message"=>"Producto encontrado correctamente",
            "data"=>$producto,
            "status"=>200,
        ];
        return response()->json($data,200);

       

    }
     //MÉTODO DELETE PRODUCTOS
    public function deleteProductos($id){
          $producto=Productos::find($id);
          
          if(!$producto){
            $data=[
                "message"=>"El producto a eliminar no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
          }
          //No útilizamos delte por que puede afectar el orden nuestra bd
          $producto->estado=false;
          $producto->save();
          $data=[
            "message"=>"Producto eliminado correctamente",
            "data"=>$producto,
            "status"=>200,
          ];
          return response()->json($data,200);
    }

    public function putProductos(Request $request,$id){
        $producto=Productos::find($id);
        if(!$producto){
            $data=[
                "message"=>"El producto no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }
        $validate=Validator::make($request->all(),[
            "nombre"=>"required||max:50",
            "descripcion"=>"required||max:100"
        ]);
        if($validate->fails()){
            $data=[
                "message"=>"Hubo un error en los datos ingresados",
                "error"=>$validate->errors(),
                "status"=>404,
            ];
            return response()->json($data,404);
        }

        $producto->nombre=$request->nombre;
        $producto->descripcion=$request->descripcion;
        //GUARDAMOS EL PRODUCTOS EDITADO
        $producto->save();
        $data=[
            "message"=>"Producto editado correctamente",
            "data"=>$producto,
            "status"=>200,
        ];
        return response()->json($data,200);
    }

    //METODO PATCH PRODUCTOS
    public function patchProductos(Request $request,$id){
        $producto=Productos::find($id);
        if(!$producto){
            $data=[
                "message"=>"El producto no fue encontrado",
                "status"=>404,
            ];
            return response()->json($data,404);
        }
        $validate=Validator::make($request->all(),[
            "nombre"=>"max:50",
            "descripcion"=>"max:100",
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
        $producto->nombre=$request->nombre;
    }
    if($request->has("descripcion")){
        $producto->descripcion=$request->descripcion;
    }
    $producto->save();
    $data=[
        "message"=>"Campo editado correctamente",
        "data"=>$producto,
        "status"=>200,
    ];
    return response()->json($data,200);
}
}
