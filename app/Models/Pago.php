<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'pedido_id',
        'metodo',
        'estado',
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
    ];

    /**
     * Métodos de pago disponibles
     */
    public const METODOS = [
        'efectivo',
        'tarjeta'
    ];

    /**
     * Estados posibles de un pago
     */
    public const ESTADOS = [
        'pendiente',
        'pagado',
        'fallido'
    ];

    /**
     * Relación con el pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Scope para pagos completados
     */
    public function scopeCompletados($query)
    {
        return $query->where('estado', 'pagado');
    }

    /**
     * Scope para pagos por método
     */
    public function scopePorMetodo($query, $metodo)
    {
        return $query->where('metodo', $metodo);
    }

    /**
     * Marcar pago como completado
     */
    public function marcarComoPagado()
    {
        $this->estado = 'pagado';
        $this->fecha_pago = now();
        $this->save();
    }
}