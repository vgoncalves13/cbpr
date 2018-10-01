<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Associados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->increments('id');

            $table->string('matricula_antiga')->nullable($value = true);
            $table->string('matricula_nova')->nullable($value = true);
            $table->string('graduacao')->nullable($value = true);
            $table->date('admissao')->nullable($value = true);
            $table->string('classe')->nullable($value = true);
            $table->string('nome_completo')->nullable($value = true);
            $table->string('nome_mae')->nullable($value = true);
            $table->string('nome_pai')->nullable($value = true);
            $table->string('naturalidade')->nullable($value = true);
            $table->string('estado_civil')->nullable($value = true);
            $table->date('data_nascimento')->nullable($value = true);
            $table->string('cpf')->nullable($value = true);
            $table->string('telefone_trabalho')->nullable($value = true);
            $table->string('telefone_casa')->nullable($value = true);
            $table->string('telefone_celular')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->text('observacoes')->nullable($value = true);
            $table->string('foto')->nullable($value = true);
            $table->boolean('status')->default($value = 1);

            //Soft Delete
            $table->softDeletes();
            // Campos de tempo, criado em e atualizado em
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
        //
    }
}
