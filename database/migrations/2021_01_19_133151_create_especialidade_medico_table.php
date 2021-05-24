<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadeMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidade_medico', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('especialidade_id');
            $table->foreign('especialidade_id')
                ->references('id')
                ->on('especialidades')->onDelete('cascade');

            $table->unsignedInteger('medico_id');
            $table->foreign('medico_id')
                ->references('id')
                ->on('medicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidade_medico');
    }
}
