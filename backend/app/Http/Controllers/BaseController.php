<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $model;

    public function getItems() {
        $items = collect($this->model::all())->filter(function($value){
            return $value["estado"] == true;
        });

        if ($items->isEmpty()) {
            $data = [
                "message" => "No se encontró ningún " . strtolower(class_basename($this->model)),
                "status" => 204,
                "data" => []
            ];
            return response()->json($data, 200);
        }

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . "s encontrados correctamente",
            "data" => $items,
            "status" => 200,
        ];

        return response()->json($data, 200);
    }

    public function findItemById($id) {
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => ucfirst(strtolower(class_basename($this->model))) . " con el id no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . " encontrado correctamente",
            "data" => $item,
            "status" => 200,
        ];

        return response()->json($data, 200);
    }

    public function createItem(Request $request, array $validationRules) {
        Log::info($request->all());

        // Validar los datos entrantes
        $validate = Validator::make($request->all(), $validationRules);

        if ($validate->fails()) {
            $data = [
                "message" => "Hubo un error con los datos ingresados",
                "error" => $validate->errors(),
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Si no se pasa un valor de 'estado', se asigna true por defecto
        $request->merge(["estado" => $request->input("estado", true)]);

        // Crear el nuevo registro
        $item = $this->model::create($request->all());

        if (!$item) {
            $data = [
                "message" => "Hubo un error al crear el " . strtolower(class_basename($this->model)),
                "status" => 500,
            ];
            return response()->json($data, 500);
        }

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . " creado correctamente",
            "data" => $item,
            "status" => 201
        ];
        return response()->json($data, 201);
    }

    public function updateItem(Request $request, $id, array $validationRules) {
        // Buscar el modelo
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => ucfirst(strtolower(class_basename($this->model))) . " no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar los datos entrantes
        $validate = Validator::make($request->all(), $validationRules);

        if ($validate->fails()) {
            $data = [
                "message" => "Hubo un error en los datos ingresados",
                "error" => $validate->errors(),
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Actualizar los campos del modelo
        $item->update($request->all());

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . " editado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }

    public function patchItem(Request $request, $id, array $validationRules) {
        // Buscar el modelo
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => ucfirst(strtolower(class_basename($this->model))) . " no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Validar los datos entrantes
        $validate = Validator::make($request->all(), $validationRules);

        if ($validate->fails()) {
            $data = [
                "message" => "Hubo un error en los datos ingresados",
                "error" => $validate->errors(),
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Actualizar los campos del modelo solo si están presentes en la solicitud
        foreach ($request->all() as $key => $value) {
            if ($request->has($key)) {
                $item->$key = $value;
            }
        }

        $item->save();

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . " fue editado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }

    public function deleteItem($id) {
        // Buscar el modelo por ID
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => ucfirst(strtolower(class_basename($this->model))) . " no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Realizar la eliminación lógica (marcar 'estado' como falso)
        $item->estado = false;
        $item->save();

        $data = [
            "message" => ucfirst(strtolower(class_basename($this->model))) . " eliminado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }
}
