<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id'); // Corrected column type
            $table->enum('estado', ['pendiente', 'preparación', 'en camino', 'entregado', 'cancelado'])->default('pendiente'); // Fixed typo and added default value
            $table->decimal('total', 10, 2);
            $table->text('direccion_entrega')->nullable();
            $table->timestamp('fecha_pedido')->useCurrent();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
