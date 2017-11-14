<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_opened')->nullable();
            $table->double('balance')->nullable();
            $table->string('status')->nullable();
            $table->integer('establishment_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('establishment_id')->references('id')->on('establishments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishment_accounts');
    }
}
