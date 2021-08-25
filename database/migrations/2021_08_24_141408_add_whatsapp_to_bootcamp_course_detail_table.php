<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappToBootcampCourseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp_course_details', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('bootcamp_trial_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bootcamp_course_details', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->after('bootcamp_trial_price');
        });
    }
}
