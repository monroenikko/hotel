<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id');
            $table->integer('room_id');
            $table->string('extra_name');
            $table->string('extra_category');
            $table->double('extra_price');
            $table->integer('extra_qty');
            $table->double('total_cost');

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
        Schema::dropIfExists('customer_extras');
    }
}
