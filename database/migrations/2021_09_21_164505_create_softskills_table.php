<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftskillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softskills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_detail_id');
            $table->foreign('candidate_detail_id')->references('id')->on('candidate_details')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->unsignedInteger('score')->nullable();
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
        Schema::dropIfExists('softskills');
    }
}
