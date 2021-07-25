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
            $table->unsignedBigInteger('bootcamp_application_id');
            $table->foreign('bootcamp_application_id')->references('id')->on('bootcamp_application')->onDelete('cascade');
            $table->string('meeting_link');
            $table->string('syllabus');
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
