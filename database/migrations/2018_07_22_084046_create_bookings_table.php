<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // di pa ako tapos dito
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('bookingID');
            $table->integer('bookingroomID');
            $table->date('bookingDate', 6);
            $table->date('checkinDate', 6);
            $table->date('checkouDate', 6);
            $table->string('bookingroomcategory', 30);
            $table->integer('bookingcustomerID');
            $table->integer('bookingstatusID');
            $table->integer('bookingTotalNights');
            $table->double('bookingTotalCost');
            $table->integer('bookingTotalAdults');
            $table->integer('bookingTotalChild');
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
        Schema::dropIfExists('bookings');
    }
}
