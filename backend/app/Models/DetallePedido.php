<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detalle_pedido';
    protected $fillable = [
        'descripcion',
        'cantidad',
        'precio_unitario',
        'id_mesa',
        'id_pedido',
        'id_producto',
    ];
}
