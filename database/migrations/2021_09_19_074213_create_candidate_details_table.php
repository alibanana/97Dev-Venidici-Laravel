<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('preferred_working_location')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('whatsapp_number', 16)->nullable();
            $table->text('about_me_description')->nullable();
            $table->text('experience_year')->nullable();
            $table->text('industry')->nullable();
            $table->text('cv_file')->nullable();
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
        Schema::dropIfExists('candidate_details');
    }
}
