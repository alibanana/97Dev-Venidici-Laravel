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
            $table->string('telephone', 16);
            $table->string('referral_code', 6);
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->text('address')->nullable();
            $table->string('company')->nullable();
            $table->string('occupancy')->nullable();
            $table->text('interest')->nullable();
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
