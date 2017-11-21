<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBeerLovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beer_lovers', function (Blueprint $table) {
            $table->string('firebase_id')->nullable();
            $table->boolean('cocktail',20)->nullable();
            $table->string('cocktail_type',20)->nullable();
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
            $table->dropColumn('firebase_id');
            $table->dropColumn('cocktail');
            $table->dropColumn('cocktail_type');
        });
    }
}
