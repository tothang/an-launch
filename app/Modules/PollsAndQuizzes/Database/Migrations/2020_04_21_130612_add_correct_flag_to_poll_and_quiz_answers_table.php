<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorrectFlagToPollAndQuizAnswersTable extends Migration
{
    public function up(): void
    {
        Schema::table('poll_and_quiz_answers', function (Blueprint $table) {
            $table->boolean('correct')->default(0)->after('value');
        });
    }

    public function down(): void
    {
        Schema::table('poll_and_quiz_answers', function (Blueprint $table) {
            $table->dropColumn('correct');
        });
    }
}
