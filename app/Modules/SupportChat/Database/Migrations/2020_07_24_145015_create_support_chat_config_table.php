<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportChatConfigTable extends Migration
{
    public function up(): void
    {
        Schema::create('support_chat_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_token');
            $table->boolean('is_active')->default(true);
            $table->string('name');
            $table->string('type');
            $table->string('colour')->nullable();
            $table->string('background_colour')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_chat_config');
    }
}
