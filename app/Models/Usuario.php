<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'usuarios';
    
    protected $fillable = [
        'nombre', 'email', 'password', 'telefono', 'direccion', 'rol'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}

?>