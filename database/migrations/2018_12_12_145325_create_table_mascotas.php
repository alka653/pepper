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
            $table->integer('propietario_id')->unsigned()->nullable();
            $table->foreign('propietario_id')->references('id')->on('personas');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo', ['M','F'])->nullable();
            $table->string('color', 100)->nullable();
            $table->longText('descripcion')->nullable();
            $table->enum('estado', ['V','M'])->nullable();
            $table->boolean('vacunado');
            $table->date('fecha_vacunacion')->nullable();
            $table->integer('raza_id')->unsigned()->nullable();
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
