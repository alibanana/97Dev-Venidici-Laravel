<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('krest_program_id')->nullable();
            $table->foreign('krest_program_id')->references('id')->on('krest_programs')->onDelete('set null');     
            $table->string('name');
            $table->string('email');
            $table->string('telephone', 16);
            $table->string('company');
            $table->string('tahu_dari_mana');
            $table->text('message')->nullable();
            $table->enum('status', ['Pending', 'Contacted', 'Rejected'])->default('Pending');
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
        Schema::dropIfExists('krests');
    }
}
