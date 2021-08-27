<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricingDescriptionsToBootcampCourseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp_course_details', function (Blueprint $table) {
            $table->text('income_share_description')->nullable()->after('whatsapp');
            $table->text('full_payment_description')->nullable()->after('whatsapp');
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
            $table->text('income_share_description')->nullable();
            $table->text('full_payment_description')->nullable();
        });
    }
}
