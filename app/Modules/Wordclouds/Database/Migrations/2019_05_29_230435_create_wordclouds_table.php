<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordcloudsTable extends Migration
{
    public function up(): void
    {
        Schema::create('wordclouds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stream_id')->references('id')->on('streams')->onDelete('cascade');
            $table->text('question');
            $table->boolean('active')->default(0);
            $table->integer('character_limit')->unsigned()->default(20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wordclouds');
    }
}
