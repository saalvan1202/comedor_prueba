<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    protected $model;

    public function getItems() {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        $items = $this->model::where('estado', true)->get();

        if ($items->isEmpty()) {
            $data = [
                "message" => "No se encontró ningún " . $className,
                "status" => 204,
                "data" => []
            ];
            return response()->json($data, 200);
        }

        $data = [
            "message" => $className . "s encontrados correctamente",
            "data" => $items,
            "status" => 200,
        ];

        return response()->json($data, 200);
    }

    public function findItemById($id) {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => $className . " con el id no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "message" => $className . " encontrado correctamente",
            "data" => $item,
            "status" => 200,
        ];

        return response()->json($data, 200);
    }

    public function createItem(Request $request, array $validationRules) {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        // Validar los datos entrantes
        $validate = Validator::make($request->all(), $validationRules);

        if ($validate->fails()) {
            return response()->json([
                "message" => "Hubo un error con los datos ingresados",
                "error" => $validate->errors(),
                "status" => 404,
            ], 404);
        }

        // Crear el nuevo registro con estado true por defecto si no está presente
        $item = $this->model::create(
            array_merge(
                $request->all(),
                ['estado' => $request->input('estado', true)]
            )
        );

        // Manejo de error en la creación del registro
        if (!$item) {
            return response()->json([
                "message" => "Hubo un error al crear el " . $className,
                "status" => 500,
            ], 500);
        }

        // Retornar respuesta de éxito
        return response()->json([
            "message" => $className . " creado correctamente",
            "data" => $item,
            "status" => 201
        ], 201);
    }

    public function updateItem(Request $request, $id, array $validationRules) {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        // Buscar el modelo
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => $className . " no fue encontrado",
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
            "message" => $className . " editado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }

    public function patchItem(Request $request, $id, array $validationRules) {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        // Buscar el modelo
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => $className . " no fue encontrado",
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
            "message" => $className . " fue editado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }

    public function deleteItem($id) {
        $className = strtolower(class_basename($this->model)); // Calcular una vez

        // Buscar el modelo por ID
        $item = $this->model::find($id);

        if (!$item) {
            $data = [
                "message" => $className . " no fue encontrado",
                "status" => 404,
            ];
            return response()->json($data, 404);
        }

        // Realizar la eliminación lógica (marcar 'estado' como falso)
        $item->estado = false;
        $item->save();

        $data = [
            "message" => $className . " eliminado correctamente",
            "data" => $item,
            "status" => 200,
        ];
        return response()->json($data, 200);
    }
}
