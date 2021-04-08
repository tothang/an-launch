<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStreamIdToPollsAndQuizzesTable extends Migration
{
    public function up(): void
    {
        Schema::table('polls_and_quizzes', function (Blueprint $table) {
            $table->unsignedInteger('stream_id')->after('position')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('polls_and_quizzes', function (Blueprint $table) {
            $table->dropColumn([
                'stream_id'
            ]);
        });
    }
}
