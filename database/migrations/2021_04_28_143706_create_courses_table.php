<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_type_id')->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types')->onDelete('set null');
            $table->unsignedBigInteger('course_category_id')->nullable();
            $table->foreign('course_category_id')->references('id')->on('course_categories')->onDelete('set null');
            $table->string('thumbnail');
            $table->string('preview_video');
            $table->string('title');
            $table->text('subtitle');
            $table->text('description');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('priceWithArtKit')->nullable();
            $table->enum('enrollment_status', ['Open', 'Close'])->default('Open');
            $table->enum('publish_status', ['Draft', 'Published'])->default('Draft');
            $table->string('total_duration')->nullable(); // (mins), (secs)
            $table->unsignedDecimal('average_rating', 2, 1)->default(0);
            $table->boolean('isDeleted')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
