<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameQuestionIdColumn extends Migration
{
    public function up(): void
    {
        Schema::table('poll_and_quiz_responses', function(Blueprint $table) {
            $table->renameColumn('question_id', 'poll_and_quiz_question_id');
        });

        Schema::table('poll_and_quiz_answers', function(Blueprint $table) {
            $table->renameColumn('question_id', 'poll_and_quiz_question_id');
        });
    }

    public function down(): void
    {
        Schema::table('poll_and_quiz_responses', function(Blueprint $table) {
            $table->renameColumn('poll_and_quiz_question_id', 'question_id');
        });

        Schema::table('poll_and_quiz_answers', function(Blueprint $table) {
            $table->renameColumn('poll_and_quiz_question_id', 'question_id');
        });
    }
}
