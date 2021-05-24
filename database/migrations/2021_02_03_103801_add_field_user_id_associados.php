<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUserIdAssociados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->addColumn('integer','user_id')->after('id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
