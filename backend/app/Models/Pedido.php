<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pedido';
    protected $fillable = [
        'tipo_pedido',
        'fecha',
        'estado'
    ];
}
