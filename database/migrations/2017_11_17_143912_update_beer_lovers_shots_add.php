<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBeerLoversShotsAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beer_lovers', function (Blueprint $table) {
            $table->boolean('shot')->nullable();
            $table->boolean('shot_type')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beer_lovers', function (Blueprint $table) {
            $table->dropColumn('shot');
            $table->dropColumn('shot_type');
        });
    }
}
