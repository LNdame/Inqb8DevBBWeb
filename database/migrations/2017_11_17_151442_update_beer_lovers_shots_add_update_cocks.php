<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBeerLoversShotsAddUpdateCocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beer_lovers', function (Blueprint $table) {
            $table->string('cocktail_type',20)->change();
            $table->boolean('cocktail')->change();
            $table->boolean('shot')->change();
            $table->string('shot_type',20)->change();
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
            $table->boolean('cocktail_type',20)->change();
            $table->string('cocktail')->change();
            $table->string('shot')->change();
            $table->boolean('shot_type',20)->change();
        });
    }
}
