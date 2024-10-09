<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MesaController;

Route::prefix("mesa")->group(function(){
    Route::get("",[MesaController::class,"getMesas"]);
    Route::get("{id}",[MesaController::class,"findMesa"]);
    Route::post("",[MesaController::class,"postMesa"]);
    Route::put("{id}",[MesaController::class,"putMesa"]);
    Route::patch("{id}",[MesaController::class,"patchMesa"]);
    Route::delete("{id}",[MesaController::class,"deleteMesa"]);
});
