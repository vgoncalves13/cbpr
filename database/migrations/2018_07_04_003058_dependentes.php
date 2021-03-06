<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dependentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_dependente')->nullable();
            $table->string('cpf')->nullable();
            $table->string('grau_parentesco')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->integer('associado_id')->unsigned();
            $table->boolean('status')->unsigned()->default(1);
            $table->foreign('associado_id')
                ->references('id')->on('associados')
                ->onDelete('cascade');
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
