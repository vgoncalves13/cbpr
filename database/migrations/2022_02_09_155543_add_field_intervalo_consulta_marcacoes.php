<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldIntervaloConsultaMarcacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marcacoes', function (Blueprint $table) {
            $table->integer('intervalo_consulta')->after('data_hora_consulta')->default(60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marcacoes', function (Blueprint $table) {
            $table->dropColumn('intervalo_consulta');
        });
    }
}
