<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtaquesLocalizacionesAnatomicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ataques_anatomicas', function (Blueprint $table) {
            $table->integer('ataque_id')->unsigned();
            $table->foreign('ataque_id')->references('id')->on('ataques');
            $table->integer('localizacion_anatomica_id')->unsigned();
            $table->foreign('localizacion_anatomica_id')->references('id')->on('localizaciones_anatomicas');
            $table->primary(['ataque_id','localizacion_anatomica_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ataques_anatomicas');
    }
}
