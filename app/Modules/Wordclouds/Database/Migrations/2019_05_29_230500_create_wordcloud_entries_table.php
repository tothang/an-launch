<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordcloudEntriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('wordcloud_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wordcloud_id')->unsigned()->references('id')->on('wordclouds')->onDelete('cascade');
            $table->string('word');
            $table->integer('count')->default(1);
            $table->string('status')->default('waiting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wordcloud_entries');
    }
}
