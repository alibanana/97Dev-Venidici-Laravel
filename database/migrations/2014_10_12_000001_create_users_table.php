<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_role_id')->nullable()->default(1);
            $table->foreign('user_role_id')->references('id')->on('user_roles')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('provider_id')->nullable();
            $table->text('avatar')->nullable();            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->enum('club', ['bike', 'car','jet'])->nullable();
            $table->boolean('isGeneralInfoUpdated')->default(0)->nullable();
            $table->boolean('isShippingUpdated')->default(0)->nullable();
            $table->boolean('isProfileUpdated')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
