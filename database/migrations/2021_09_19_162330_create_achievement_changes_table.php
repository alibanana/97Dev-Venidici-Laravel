<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_detail_change_id');
            $table->foreign('candidate_detail_change_id')->references('id')->on('candidate_detail_changes')->onDelete('cascade');
            $table->unsignedBigInteger('achievement_id')->nullable();
            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('location_of_event')->nullable();
            $table->year('year')->nullable();
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
        Schema::dropIfExists('achievement_changes');
    }
}
