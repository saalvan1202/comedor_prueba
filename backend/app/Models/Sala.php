<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sala';
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo_sala',
        'aforo',
        'estado',
        'id_piso'
    ];
}
