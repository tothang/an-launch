<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollAndQuizAnswersTable extends Migration
{
    public function up(): void
    {
        Schema::create('poll_and_quiz_answers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('position')->unsigned()->default(1);
            $table->integer('question_id')->unsigned()->references('id')->on('quiz_questions')->onDelete('cascade');
            $table->text('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_and_quiz_answers');
    }
}
