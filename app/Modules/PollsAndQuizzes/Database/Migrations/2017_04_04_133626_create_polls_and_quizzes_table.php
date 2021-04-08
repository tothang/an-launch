<?php

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsAndQuizzesTable extends Migration
{
    public function up(): void
    {
        Schema::create('polls_and_quizzes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('position')->unsigned()->default(1);
            $table->enum('type', PollAndQuiz::$types);
            $table->string('name');
            $table->string('description');
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polls_and_quizzes');
    }
}
