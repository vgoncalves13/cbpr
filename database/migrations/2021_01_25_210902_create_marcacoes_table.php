<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('medico_id');
            $table->foreign('medico_id')
                ->references('id')
                ->on('medicos')->onDelete('cascade');

            $table->morphs('pacienteable');

            $table->unsignedInteger('especialidade_id');
            $table->foreign('especialidade_id')
                ->references('id')
                ->on('especialidades')->onDelete('cascade');
            $table->date('dia_consulta');
            $table->string('hora_consulta');
            $table->softDeletes();
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
        Schema::dropIfExists('marcacoes');
    }
}
