<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTipoFromAtaquesSeguimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('ataques_seguimientos', 'tipo')){
            Schema::table('ataques_seguimientos', function (Blueprint $table) {
                $table->dropColumn('tipo');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ataques_seguimientos', function (Blueprint $table) {
            //
        });
    }
}
