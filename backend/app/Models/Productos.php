<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    //El proteted es un varaible que se puede útilizar son en la clase generada
    protected $table="productos";
    protected $fillable=[
        "nombre",
        "descripcion",
        "estado",
    ];
}
