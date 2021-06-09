<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('display_picture')->nullable();
            $table->string('telephone', 16)->nullable();
            $table->string('referral_code', 6)->nullable();
            $table->string('with_referral_code', 6)->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->text('address')->nullable();
            $table->string('company')->nullable();
            $table->string('occupancy')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
