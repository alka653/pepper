<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtaquesVictima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ataques_victima', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ataque_id')->unsigned();
            $table->foreign('ataque_id')->references('id')->on('ataques');
            $table->unique('ataque_id');
            $table->enum('suero_antirrabico', ['S', 'N', 'D']);
            $table->date('fecha_aplicacion_suero')->nullable();
            $table->enum('vacuna_antirrabica', ['S','N','D'])->nullable();
            $table->integer('numero_dosis')->nullable();
            $table->date('fecha_ultima_dosis');
            $table->boolean('lavado_herida');
            $table->boolean('sutura_herida');
            $table->boolean('orden_suero');
            $table->boolean('orden_aplicacion_vacuna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ataques_victima');
    }
}
