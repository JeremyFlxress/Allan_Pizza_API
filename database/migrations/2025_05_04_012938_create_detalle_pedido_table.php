<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido_id'); // llave foranea
            $table->integer('producto_id'); // llave foranea
            $table->integer('tamaño_id'); // llave foranea
            $table->integer('cantidad');    
            $table->decimal('precio', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pedido');
    }
}
