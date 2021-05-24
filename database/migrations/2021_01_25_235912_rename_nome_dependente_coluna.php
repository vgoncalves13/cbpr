<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNomeDependenteColuna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dependentes', function(Blueprint $table) {
            $table->renameColumn('nome_dependente', 'nome_completo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dependentes', function(Blueprint $table) {
            $table->renameColumn('nome_completo', 'nome_dependente');
        });
    }
}
