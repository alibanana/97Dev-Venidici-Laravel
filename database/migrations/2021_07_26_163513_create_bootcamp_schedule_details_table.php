<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bootcamp_schedule_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bootcamp_schedule_id');
            $table->foreign('bootcamp_schedule_id')->references('id')->on('bootcamp_schedules')->onDelete('cascade');
            $table->text('description');
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
        Schema::dropIfExists('bootcamp_schedule_details');
    }
}
