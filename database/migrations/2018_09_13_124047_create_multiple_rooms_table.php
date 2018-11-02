<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rsvn_no');
            $table->string('cust_fn');
            $table->string('cust_ln');
            $table->string('total_night');
            $table->double('downpayment');
            $table->integer('customer_id');
            $table->date('dateArrival');
            $table->date('dateDeparture');
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
        Schema::dropIfExists('multiple_rooms');
    }
}
