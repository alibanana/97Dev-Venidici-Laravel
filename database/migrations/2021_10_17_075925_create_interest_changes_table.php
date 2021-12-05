<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_detail_change_id');
            $table->foreign('candidate_detail_change_id')->references('id')->on('candidate_detail_changes')->onDelete('cascade');
            $table->unsignedBigInteger('interest_id')->nullable();
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->string('title')->nullable();
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
        Schema::dropIfExists('interest_changes');
    }
}
