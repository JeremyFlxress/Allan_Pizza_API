<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'usuario_id',
        'estado',
        'total',
        'direccion_entrega',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'fecha_pedido' => 'datetime',
    ];

    /**
     * Estados posibles de un pedido
     */
    public const ESTADOS = [
        'pendiente',
        'preparación',
        'en camino',
        'entregado',
        'cancelado'
    ];

    /**
     * Relación con el usuario que hizo el pedido
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Relación con los detalles del pedido
     */
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    /**
     * Relación con los pagos asociados
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    /**
     * Obtener el pago completado (si existe)
     */
    public function pagoCompletado()
    {
        return $this->hasOne(Pago::class)->where('estado', 'pagado');
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Calcular el total del pedido basado en los detalles
     */
    public function calcularTotal()
    {
        return $this->detalles->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->precio;
        });
    }
}