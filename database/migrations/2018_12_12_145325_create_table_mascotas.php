<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMascotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 20);
            $table->integer('propietario_id')->unsigned();
            $table->foreign('propietario_id')->references('id')->on('personas');
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['M','F']);
            $table->string('color', 20);
            $table->longText('descripcion');
            $table->enum('estado', ['V','M']);
            $table->boolean('vacunado');
            $table->date('fecha_vacunacion')->nullable();
            $table->integer('raza_id')->unsigned();
            $table->foreign('raza_id')->references('id')->on('razas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
