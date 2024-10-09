<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piso;

class PisoController extends Controller
{
    public function __construct() {
        $this->model = Piso::class;
    }

    public function getPisos() {
        return $this->getItems();
    }

    public function findPiso($id) {
        return $this->findItemById($id);
    }

    public function postPiso(Request $request) {
        $validationRules = [
            "nombre" => "string|required|max:100",
            "descripcion" => "string|required|max:255",
            "estado" => "boolean",
        ];

        return $this->createItem($request, $validationRules);
    }

    public function putPiso(Request $request, $id) {
        $validationRules = [
            "nombre" => "string|required|max:100",
            "descripcion" => "string|required|max:255",
            "estado" => "boolean|required",
        ];

        return $this->updateItem($request, $id, $validationRules);
    }

    public function patchPiso(Request $request, $id) {
        $validationRules = [
            "nombre" => "string|max:100",
            "descripcion" => "string|max:255",
            "estado" => "boolean"
        ];

        return $this->patchItem($request, $id, $validationRules);
    }

    public function deletePiso($id) {
        return $this->deleteItem($id);
    }
}
