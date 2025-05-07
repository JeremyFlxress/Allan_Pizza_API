<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';

    protected $fillable = [
        'nombre',
        'disponible',
    ];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    /**
     * Relación muchos a muchos con productos
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_ingrediente')
                    ->withTimestamps();
    }

    /**
     * Scope para ingredientes disponibles
     */
    public function scopeDisponibles($query)
    {
        return $query->where('disponible', true);
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeBuscar($query, $nombre)
    {
        return $query->where('nombre', 'like', "%{$nombre}%");
    }
}