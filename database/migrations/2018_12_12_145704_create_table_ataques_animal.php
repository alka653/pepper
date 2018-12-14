<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtaquesAnimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ataques_animal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ataque_id')->unsigned();
            $table->foreign('ataque_id')->references('id')->on('ataques');
            $table->unique('ataque_id');
            $table->enum('animal_vacunado', ['S','N','D']);
            $table->boolean('carnet_vacunacion');
            $table->enum('estado_animal_ataque', ['CS','SS','D']);
            $table->enum('estado_animal_consulta', ['V','M','D']);
            $table->enum('ubicacion_animal_agresion', ['O','P']);
            $table->enum('tipo_exposicion', ['N','EL','EG']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ataques_animal');
    }
}
