<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->bigIncrements('id_orden');
            $table->integer('id_cliente');
            $table->integer('id_producto');
            $table->integer('cantidad_piezas');
            $table->decimal('precio_unitario',8,4);
            $table->string('tipo_empaque');
            /*$table->date('fecha_creacion');*/
            $table->date('fecha_produccion');
            $table->date('fecha_entrega');
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
        Schema::dropIfExists('ordenes');
    }
}
