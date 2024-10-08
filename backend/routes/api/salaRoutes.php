<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaController;

Route::prefix("sala")->group(function(){
    Route::get("",[SalaController::class,"getSalas"]);
    Route::get("{id}",[SalaController::class,"findSala"]);
    Route::post("",[SalaController::class,"postSala"]);
    Route::put("{id}",[SalaController::class,"putSala"]);
    Route::patch("{id}",[SalaController::class,"patchSala"]);
    Route::delete("{id}",[SalaController::class,"deletePiso"]);
});
