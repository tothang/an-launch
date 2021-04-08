<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stream_id')->references('id')->on('streams')->onDelete('cascade');
            $table->integer('session')->unsigned()->default(1);
            $table->integer('user_id')->unsigned();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->text('question');
            $table->boolean('read')->default(0);
            $table->boolean('on_screen')->default(0);
            $table->string('status')->default('waiting');
            $table->boolean('hidden')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}
