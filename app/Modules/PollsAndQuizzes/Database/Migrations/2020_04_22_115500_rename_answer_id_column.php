<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAnswerIdColumn extends Migration
{
    public function up(): void
    {
        Schema::table('poll_and_quiz_responses', function(Blueprint $table) {
            $table->renameColumn('answer_id', 'poll_and_quiz_answer_id');
        });
    }

    public function down(): void
    {
        Schema::table('poll_and_quiz_responses', function(Blueprint $table) {
            $table->renameColumn('poll_and_quiz_answer_id', 'answer_id');
        });
    }
}
