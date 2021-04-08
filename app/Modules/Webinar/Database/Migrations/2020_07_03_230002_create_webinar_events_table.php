<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebinarEventsTable extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_events', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('stream_id')->references('id')->on('streams');
            $table->string('event');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_events');
    }
}
