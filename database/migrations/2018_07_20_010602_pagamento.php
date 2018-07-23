<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pagamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('janeiro', 8, 2)->nullable();
            $table->decimal('fevereiro', 8, 2)->nullable();
            $table->decimal('marco', 8, 2)->nullable();
            $table->decimal('abril', 8, 2)->nullable();
            $table->decimal('maio', 8, 2)->nullable();
            $table->decimal('junho', 8, 2)->nullable();
            $table->decimal('julho', 8, 2)->nullable();
            $table->decimal('agosto', 8, 2)->nullable();
            $table->decimal('setembro', 8, 2)->nullable();
            $table->decimal('outubro', 8, 2)->nullable();
            $table->decimal('novembro', 8, 2)->nullable();
            $table->decimal('dezembro', 8, 2)->nullable();
            $table->string('ano')->nullable();
            $table->integer('associado_id')->unsigned();
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
