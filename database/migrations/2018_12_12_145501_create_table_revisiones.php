<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRevisiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->integer('inspector_id')->unsigned()->nullable();
            $table->foreign('inspector_id')->references('id')->on('users');
            $table->longText('observacion')->nullable();
            $table->enum('estado', ['R','N','P']);
            $table->enum('modo', ['1','2','3']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisiones');
    }
}
