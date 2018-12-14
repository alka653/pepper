<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtaques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ataques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('victima_id')->unsigned();
            $table->foreign('victima_id')->references('id')->on('personas');
            $table->integer('mascota_id')->unsigned();
            $table->foreign('mascota_id')->references('id')->on('mascotas');
            $table->date('fecha_ataque');
            $table->longText('descripcion');
            $table->integer('tipo_ataque_id')->unsigned();
            $table->foreign('tipo_ataque_id')->references('id')->on('tipos_ataques');
            $table->enum('ataque_mordedura', ['C','D'])->nullable();
            $table->integer('municipio_ataque_id')->unsigned();
            $table->foreign('municipio_ataque_id')->references('id')->on('municipios');
            $table->boolean('agresion_provocada');
            $table->enum('tipo_lesion', ['U','M']);
            $table->enum('profundidad', ['S','P']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ataques');
    }
}
