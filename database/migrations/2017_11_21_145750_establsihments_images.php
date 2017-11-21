<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstablsihmentsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establishments', function (Blueprint $table) {
            $table->string('main_picture_url')->nullable();
            $table->string('picture_2')->nullable();
            $table->string('picture_3')->nullable();
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
            $table->dropColumn('main_picture_url');
            $table->dropColumn('picture_2');
            $table->dropColumn('picture_3');
        });
    }
}
