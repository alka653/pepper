<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSeguimientosAtaques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos_ataques', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('ataque_id')->unsigned();
            $table->foreign('ataque_id')->references('id')->on('ataques');
            $table->longText('descripcion');
            $table->enum('tipo', ['V','A']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientos_ataques');
    }
}
