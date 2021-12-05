<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_detail_change_id');
            $table->foreign('candidate_detail_change_id')->references('id')->on('candidate_detail_changes')->onDelete('cascade');
            $table->unsignedBigInteger('education_id')->nullable();
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
            $table->string('degree')->nullable();
            $table->string('school')->nullable();
            $table->string('major')->nullable();
            $table->unsignedInteger('start_year')->nullable();
            $table->unsignedInteger('end_year')->nullable();
            $table->enum('action', ['create', 'update', 'delete']);
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
        Schema::dropIfExists('education_changes');
    }
}
