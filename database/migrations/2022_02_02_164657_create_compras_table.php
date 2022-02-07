<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');

            $table->integer('id_producto');
            $table->foreign('id_producto')->references('id_producto')->on('productos');

            $table->integer('numero_boleta');
            $table->foreign('numero_boleta')->references('numero_boleta')->on('boletas');


            $table->integer('cantidad_productos');
            $table->string('direccion_productos')->nullable()->default(null);
            
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
        Schema::dropIfExists('compras');
    }
}
