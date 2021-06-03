<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('linkedIn');
            $table->text('address');
            $table->string('company')->nullable();
            $table->enum('education', ['SMP', 'SMA', 'S1', 'S2']);
            $table->string('university');
            $table->string('job')->nullable();
            $table->unsignedBigInteger('instructor_position_id')->nullable();
            $table->foreign('instructor_position_id')->references('id')->on('instructor_positions')->onDelete('set null');
            $table->integer('salary');
            $table->string('cv')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
