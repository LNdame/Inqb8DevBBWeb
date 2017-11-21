<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEstablishments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishments', function (Blueprint $table) {
            $table->renameColumn('geo_tag','latitude');
            $table->string('longtitude',20);
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
            $table->dropColumn('longtitude',20);
            $table->string('geotag');
        });
    }
}
