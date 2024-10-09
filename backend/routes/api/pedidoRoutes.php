<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::prefix("pedido")->group(function(){
    Route::get("",[PedidoController::class,"getPedido"]);
    Route::get("{id}",[PedidoController::class,"findPedido"]);
    Route::post("",[PedidoController::class,"postPedido"]);
    Route::put("{id}",[PedidoController::class,"putPedido"]);
    Route::patch("{id}",[PedidoController::class,"patchPedido"]);
    Route::delete("{id}",[PedidoController::class,"deletePedido"]);
});
