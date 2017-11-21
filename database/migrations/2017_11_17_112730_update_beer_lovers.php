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
            $table->string('gender',20);
            $table->string('home_city',100)->nullable();
            $table->string('referal_code',50)->nullable();

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
            $table->dropColumn('gender');
            $table->dropColumn('home_city');
            $table->dropColumn('referal_code');
        });
    }
}
