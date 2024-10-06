<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productosController;

//Englobamos todas la rutas para que se puedan importar a la ruta principal de api
Route::prefix("productos")->group(function(){
Route::get("",[productosController::class,"getProductos"]);
Route::post("",[productosController::class,"postProductos"]);
});