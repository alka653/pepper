<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewRowToMascotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->date('fecha_ingreso')->nullable();
            $table->string('ocupacion', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mascotas', function (Blueprint $table) {
            //
        });
    }
}
