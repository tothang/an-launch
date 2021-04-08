<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollAndQuizQuestionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('poll_and_quiz_questions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('position')->unsigned()->default(1);
            $table->integer('poll_and_quiz_id')->unsigned()->references('id')->on('polls_and_quizzes')->onDelete('cascade');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_and_quiz_questions');
    }
}
