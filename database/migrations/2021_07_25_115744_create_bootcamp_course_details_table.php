<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bootcamp_course_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('meeting_link')->nullable();
            $table->string('syllabus')->nullable();
            $table->date('date_start');
            $table->date('date_end');
            $table->date('trial_date_end');
            $table->unsignedInteger('bootcamp_full_price')->default(0);
            $table->unsignedInteger('bootcamp_trial_price')->default(0);
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
        Schema::dropIfExists('bootcamp_course_details');
    }
}
