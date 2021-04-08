<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollAndQuizResponsesTable extends Migration
{
    public function up(): void
    {
        Schema::create('poll_and_quiz_responses', function(Blueprint $table){
            $table->increments('id');
            $table->integer('question_id')->unsigned()->references('id')->on('quiz_questions')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->integer('answer_id')->unsigned()->references('id')->on('quiz_answers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_and_quiz_responses');
    }
}
