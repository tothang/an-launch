<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();

            $table->string('password');
            $table->boolean('setup_complete')->default(1);

            $table->string('session_id')->nullable();
            $table->string('api_token');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
