<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up(): void
    {
        Schema::create('events', static function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('code');

            $table->string('client');
            $table->string('name');
            $table->dateTime('start');
            $table->dateTime('end');

            $table->string('client_logo')->nullable();
            $table->string('event_logo')->nullable();
            $table->string('privacy_policy')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}
