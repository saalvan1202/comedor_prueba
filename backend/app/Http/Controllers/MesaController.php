<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use App\Models\Mesa;

use App\Models\Piso;
use Illuminate\Support\Facades\Log;

class MesaController extends Controller
{
    public function __construct() {
        $this->model = Mesa::class;
    }

    public function getMesas() {
        return $this->getItems();
    }

    public function findMesa($id) {
        return $this->findItemById($id);
    }

    public function postMesa(Request $request) {
        $validationRules = [
            "numero_mesa"=>"string|required|max:3",
            "tipo_mesa"=>"string|required|max:20",
            "capacidad"=>"integer|required",
            "estado"=>"boolean",
            "id_sala"=>"integer|required",
        ];

        return $this->createItem($request, $validationRules);
    }

    public function putMesa(Request $request, $id) {
        $validationRules = [
            "numero_mesa"=>"string|required|max:3",
            "tipo_mesa"=>"string|required|max:20",
            "capacidad"=>"integer|required",
            "estado"=>"boolean|required",
            "id_sala"=>"integer|required",
        ];

        return $this->updateItem($request, $id, $validationRules);
    }

    public function patchMesa(Request $request, $id) {
        $validationRules = [
            "numero_mesa"=>"string|max:3",
            "tipo_mesa"=>"string|max:20",
            "capacidad"=>"integer",
            "estado"=>"boolean",
            "id_sala"=>"integer",
        ];

        return $this->patchItem($request, $id, $validationRules);
    }

    public function deleteMesa($id) {
        return $this->deleteItem($id);
    }

    // Custom controllers
    public function getMesasBySala($id_piso, $id_sala) {

        $id_piso = (int) $id_piso;
        $id_sala = (int) $id_sala;

        try {
            // Obtener los pisos activos
            $pisos = Piso::select('id', 'nombre')
                ->where('estado', true)
                ->get();

            if ($pisos->isEmpty()) {
                $data = [
                    "message" => "No se encontraron pisos activos",
                    "data" => [],
                    "status" => 204,
                ];
                return response()->json($data, 200); // Termina aquí si no hay pisos
            }

            // Obtener las salas activas del piso especificado
            $salas = Sala::select('id', 'nombre', 'tipo_sala', 'aforo')
                ->where('estado', true)
                ->where('id_piso', $id_piso)
                ->get();

            if ($salas->isEmpty()) {
                $items = [
                    'pisos' => $pisos,
                    'salas' => [],
                    'mesas' => []
                ];

                $data = [
                    "message" => "No se encontraron salas activas en el piso especificado",
                    "data" => $items,
                    "status" => 204,
                ];
                return response()->json($data, 200); // Termina aquí si no hay salas
            }

            // Obtener las mesas activas de la sala especificada
            $mesas = Mesa::select('id', 'numero_mesa', 'tipo_mesa', 'capacidad')
                ->where('estado', true)
                ->where('id_sala', $id_sala)
                ->get();

            if ($mesas->isEmpty()) {
                $items = [
                    'pisos' => $pisos,
                    'salas' => $salas,
                    'mesas' => []
                ];

                $data = [
                    "message" => "No se encontraron mesas activas en la sala especificada",
                    "data" => $items,
                    "status" => 204,
                ];
                return response()->json($data, 200); // Termina aquí si no hay mesas
            }

            // Estructurar los datos
            $items = [
                'pisos' => $pisos,
                'salas' => $salas,
                'mesas' => $mesas
            ];

            // Retornar los datos en formato JSON
            $data = [
                "message" => "Datos encontrados correctamente",
                "data" => $items,
                "status" => 200,
            ];

            return response()->json($data, 200);

        } catch (\Exception $e) {
            // Capturar cualquier error inesperado y devolver una respuesta adecuada
            $data = [
                "message" => "Ocurrió un error al procesar la solicitud",
                "data" => [],
                "error" => $e->getMessage(),
                "status" => 500,
            ];

            return response()->json($data, 500);
        }
    }

}
