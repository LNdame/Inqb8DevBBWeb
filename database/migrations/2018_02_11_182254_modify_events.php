<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('longitude');
            $table->string('latitude');
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('main_picture_url')->nullable();
            $table->string('address')->nullable();
            $table->string('event_url')->nullable();

//            $table->string('establishment_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
}
