<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_question_id');
            $table->foreign('assessment_question_id')->references('id')->on('assessment_questions')->onDelete('cascade');
            $table->string('answer');
            $table->boolean('is_correct');
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
        Schema::dropIfExists('assessment_question_answers');
    }
}
