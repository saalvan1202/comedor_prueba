<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'piso';
    protected $fillable = [
        "nombre",
        "descripcion",
        "estado"
    ];
}
