<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function __construct() {
        $this->model = Pedido::class;
    }

    public function getPedido() {
        return $this->getItems();
    }

    public function findPedido($id) {
        return $this->findItemById($id);
    }

    public function postPedido(Request $request) {
        $validationRules = [
            "tipo_pedido"=>"string|required|max:20",
            "fecha"=>"date|required",
            "estado"=>"boolean",
        ];

        return $this->createItem($request, $validationRules);
    }

    public function putPedido(Request $request, $id) {
        $validationRules = [
            "tipo_pedido"=>"string|required|max:20",
            "fecha"=>"date|required",
            "estado"=>"boolean|required",
        ];

        return $this->updateItem($request, $id, $validationRules);
    }

    public function patchPedido(Request $request, $id) {
        $validationRules = [
            "tipo_pedido"=>"string|max:20",
            "fecha"=>"date",
            "estado"=>"boolean",
        ];

        return $this->patchItem($request, $id, $validationRules);
    }

    public function deletePedido($id) {
        return $this->deleteItem($id);
    }
}
