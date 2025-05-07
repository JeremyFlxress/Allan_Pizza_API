<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'tamaño_id',
        'cantidad',
        'precio',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    /**
     * Relación con el pedido padre
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Relación con el producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    /**
     * Relación con el tamaño (si aplica)
     */
    public function tamaño()
    {
        return $this->belongsTo(Tamaño::class);
    }

    /**
     * Calcular subtotal (cantidad * precio)
     */
    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio;
    }

    /**
     * Scope para productos de una categoría específica
     */
    public function scopeDeCategoria($query, $categoria)
    {
        return $query->whereHas('producto', function($q) use ($categoria) {
            $q->where('categoria', $categoria);
        });
    }
}