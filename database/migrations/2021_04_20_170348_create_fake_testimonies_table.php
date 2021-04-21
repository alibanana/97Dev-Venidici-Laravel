<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakeTestimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fake_testimonies', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->text('content');
            $table->unsignedDecimal('rating', 2, 1);
            $table->string('name')->nullable();
            $table->string('occupancy')->nullable();
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
        Schema::dropIfExists('fake_testimonies');
    }
}
