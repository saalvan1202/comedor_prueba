<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalaController extends BaseController
{
    public function __construct() {
        $this->model = Sala::class;
    }

    public function getSalas() {
        return $this->getItems();
    }

    public function findSala($id) {
        return $this->findItemById($id);
    }

    public function postSala(Request $request) {
        $validationRules = [
            "nombre"=>"string|required|max:50",
            "descripcion"=>"string|required|max:255",
            "tipo_sala"=>"string|required|max:20",
            "aforo"=>"integer|required",
            "estado"=>"boolean",
            "id_piso"=>"integer|required",
        ];

        return $this->createItem($request, $validationRules);
    }

    public function putSala(Request $request, $id) {
        $validationRules = [
            "nombre"=>"string|required|max:50",
            "descripcion"=>"string|required|max:255",
            "tipo_sala"=>"string|required|max:20",
            "aforo"=>"integer|required",
            "estado"=>"boolean|required",
            "id_piso"=>"integer|required",
        ];

        return $this->updateItem($request, $id, $validationRules);
    }

    public function patchSala(Request $request, $id) {
        $validationRules = [
            "nombre" => "string|max:50",
            "descripcion" => "string|max:255",
            "tipo_sala" => "string|max:20",
            "aforo" => "integer",
            "estado" => "boolean",
            "id_piso" => "integer",
        ];

        return $this->patchItem($request, $id, $validationRules);
    }

    public function deletePiso($id) {
        return $this->deleteItem($id);
    }
}
