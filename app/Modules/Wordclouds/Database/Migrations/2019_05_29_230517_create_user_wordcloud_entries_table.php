<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWordcloudEntriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_wordcloud_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registration_id')->unsigned()
                ->references('id')->on('delegate_registrations')->onDelete('cascade');
            $table->integer('wordcloud_entry_id')->unsigned()
                ->references('id')->on('wordcloud_entries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wordcloud_entries');
    }
}
