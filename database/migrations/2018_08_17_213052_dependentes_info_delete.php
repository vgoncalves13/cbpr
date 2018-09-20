<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DependentesInfoDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes_delete_info', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_solicitacao')->nullable();
            $table->string('documento_comprovante')->nullable();
            $table->text('observacao')->nullable();
            $table->integer('dependente_id')->unsigned();
            $table->foreign('dependente_id')
                ->references('id')->on('dependentes')
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
