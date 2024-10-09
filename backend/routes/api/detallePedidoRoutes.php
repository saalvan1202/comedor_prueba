<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetallePedidoController;

Route::prefix("detalle-pedido")->group(function(){
    Route::get("",[DetallePedidoController::class,"getDetallePedidos"]);
    Route::get("{id}",[DetallePedidoController::class,"findDetallePedido"]);
    Route::post("",[DetallePedidoController::class,"postDetallePedido"]);
    Route::put("{id}",[DetallePedidoController::class,"putDetallePedido"]);
    Route::patch("{id}",[DetallePedidoController::class,"patchDetallePedido"]);
    Route::delete("{id}",[DetallePedidoController::class,"deleteDetallePedido"]);
});
