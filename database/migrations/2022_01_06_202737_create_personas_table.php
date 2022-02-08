<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('rut');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('contrasena');
            $table->boolean('ingresado')->default(false);
            //$table->string('remember_token',100);
            $table->rememberToken();
            $table->integer('id_tipo_usuario')->unsigned()->default(1);
    
            // Updating relationships
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuarios')->onDelete('cascade');
        });
    }
        /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
        Schema::dropIfExists('id_tipo_usuario');
    }
}
