<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_prints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicator_id');
            $table->date('arrivaldate');
            $table->date('departuredate');
            $table->integer('room_no');
            $table->string('room_type');
            $table->double('rom_rate');
            $table->integer('totalnights');
            $table->integer('amount');
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
        Schema::dropIfExists('report_prints');
    }
}
