<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiringPartnerCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hiring_partner_candidate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hiring_partner_id');
            $table->foreign('hiring_partner_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['archived', 'contacted', 'accepted', 'rejected', 'hired'])->default('archived');
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
        Schema::dropIfExists('hiring_partner_candidate');
    }
}
