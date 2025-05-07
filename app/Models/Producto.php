<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'imagen', 
        'categoria', 'disponible'
    ];
    
    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'producto_ingrediente');
    }
}
?>