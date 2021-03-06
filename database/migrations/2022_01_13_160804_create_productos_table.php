<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->string('nombre_producto');
            $table->integer('precio_producto');
            $table->string('talla_producto');
            $table->boolean('disponibilidad_producto');
            $table->integer('stock_producto');
            $table->text('descripcion');
            $table->text('imagen');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion')->nullable();
            $table->string('tipo_modificacion')->nullable();
            $table->boolean('visible');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }




}
