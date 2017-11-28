<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beer_lover_id')->unsigned();;
            $table->integer('establishment_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->foreign('beer_lover_id')->references('id')->on('beer_lovers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
