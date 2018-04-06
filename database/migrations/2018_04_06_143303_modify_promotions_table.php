<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishments', function (Blueprint $table) {
            //
            $table->integer('creator_id')->unsigned()->nullable();
            $table->foreign('creator_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establishments', function (Blueprint $table) {
            //
            $table->dropColumn('creator_id');
        });
    }
}
