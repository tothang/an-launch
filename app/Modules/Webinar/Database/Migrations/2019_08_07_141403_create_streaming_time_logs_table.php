<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamingTimeLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('streaming_time_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('stream_id')->references('id')->on('streams')->onDelete('cascade');
            $table->unsignedInteger('view_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('streaming_time_logs');
    }
}
