<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('preference_number');
            $table->string('status')->nullable();
            $table->integer('beer_lover_id')->unsigned();
            $table->integer('beer_id')->unsigned();
            $table->foreign('beer_lover_id')->references('id')->on('beer_lovers');
            $table->foreign('beer_id')->references('id')->on('beers');
            $table->softDeletes();
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
        Schema::dropIfExists('preferences');
    }
}
