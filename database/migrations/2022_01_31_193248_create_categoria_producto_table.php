<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_producto', function (Blueprint $table) {
            $table->increments('id_categoria_producto');
            $table->integer('id_producto');
            $table->integer('id_categoria');
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
        Schema::dropIfExists('categoria_producto');
    }
}
