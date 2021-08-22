<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconToBootcampCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bootcamp_candidates', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('course_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bootcamp_candidates', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}
