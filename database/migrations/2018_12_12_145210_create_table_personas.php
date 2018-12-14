<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->string('numero_documento', 15);
            $table->integer('municipio_expedicion_id')->unsigned();
            $table->foreign('municipio_expedicion_id')->references('id')->on('municipios');
            $table->string('direccion_residencia', 150);
            $table->integer('municipio_residencia_id')->unsigned();
            $table->foreign('municipio_residencia_id')->references('id')->on('municipios');
            $table->enum('sexo', ['M','F']);
            $table->string('ocupacion', 45)->nullable();
            $table->string('numero_celular', 10);
            $table->string('numero_telefonico', 10)->nullable();
            $table->date('fecha_nacimiento');
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
    }
}
