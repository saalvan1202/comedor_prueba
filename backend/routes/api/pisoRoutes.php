<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PisoController;

Route::prefix("piso")->group(function(){
    Route::get("",[PisoController::class,"getPisos"]);
    Route::get("{id}",[PisoController::class,"findPiso"]);
    Route::post("",[PisoController::class,"postPiso"]);
    Route::put("{id}",[PisoController::class,"putPiso"]);
    Route::patch("{id}",[PisoController::class,"patchPiso"]);
    Route::delete("{id}",[PisoController::class,"deletePiso"]);
});
