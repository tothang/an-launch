<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveFlagToPollAndQuizQuestionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('poll_and_quiz_questions', function (Blueprint $table) {
            $table->boolean('active')->default(0)->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('poll_and_quiz_questions', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
