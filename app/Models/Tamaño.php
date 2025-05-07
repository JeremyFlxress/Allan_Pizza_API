<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamaño extends Model
{
    use HasFactory;

    protected $table = 'tamaños';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_extra',
    ];

    protected $casts = [
        'precio_extra' => 'decimal:2',
    ];

    /**
     * Relación con los detalles de pedido
     */
    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class);
    }

    /**
     * Obtener el precio formateado
     */
    public function getPrecioExtraFormateadoAttribute()
    {
        return '$' . number_format($this->precio_extra, 2);
    }
}