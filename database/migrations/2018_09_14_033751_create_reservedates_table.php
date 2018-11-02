<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservedatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservedates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rsvn_no');
            $table->date('arrivaldate');
            $table->date('departuredate');
            $table->integer('totalnight');
            $table->integer('downpayment');
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
        Schema::dropIfExists('reservedates');
    }
}
