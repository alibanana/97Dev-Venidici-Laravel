<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftskillChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softskill_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_detail_change_id');
            $table->foreign('candidate_detail_change_id')->references('id')->on('candidate_detail_changes')->onDelete('cascade');
            $table->unsignedBigInteger('softskill_id')->nullable();
            $table->foreign('softskill_id')->references('id')->on('softskills')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->unsignedInteger('score')->nullable();
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
        Schema::dropIfExists('softskill_changes');
    }
}
