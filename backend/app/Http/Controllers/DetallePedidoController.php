<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallePedido;

class DetallePedidoController extends Controller
{
    public function __construct() {
        $this->model = DetallePedido::class;
    }

    public function getDetallePedidos() {
        return $this->getItems();
    }

    public function findDetallePedido($id) {
        return $this->findItemById($id);
    }

    public function postDetallePedido(Request $request) {
        $validationRules = [
            "descripcion"=>"string|required|max:255",
            "cantidad"=>"integer|required",
            "precio_unitario"=>"numeric|required|between:0,99999999.99",
            "estado"=>"boolean",
            "id_mesa"=>"integer|required",
            "id_pedido"=>"integer|required",
            "id_producto"=>"integer|required",
        ];

        return $this->createItem($request, $validationRules);
    }

    public function putDetallePedido(Request $request, $id) {
        $validationRules = [
            "descripcion"=>"string|required|max:255",
            "cantidad"=>"integer|required",
            "precio_unitario"=>"numeric|required|between:0,99999999.99",
            "estado"=>"boolean|required",
            "id_mesa"=>"integer|required",
            "id_pedido"=>"integer|required",
            "id_producto"=>"integer|required",
        ];

        return $this->updateItem($request, $id, $validationRules);
    }

    public function patchDetallePedido(Request $request, $id) {
        $validationRules = [
            "descripcion"=>"string|max:255",
            "cantidad"=>"integer",
            "precio_unitario"=>"numeric|between:0,99999999.99",
            "estado"=>"boolean",
            "id_mesa"=>"integer",
            "id_pedido"=>"integer",
            "id_producto"=>"integer",
        ];

        return $this->patchItem($request, $id, $validationRules);
    }

    public function deleteDetallePedido($id) {
        return $this->deleteItem($id);
    }
}
