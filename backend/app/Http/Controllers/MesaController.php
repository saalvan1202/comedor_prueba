<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;

class MesaController extends BaseController
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
}
