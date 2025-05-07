<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido_id'); // Foreign key to 'pedidos' table
            $table->enum('metodo', ['efectivo', 'tarjeta']);
            $table->enum('estado', ['pendiente', 'pagado', 'fallido'])->default('pendiente');
            $table->timestamp('fecha_pago')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
