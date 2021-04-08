<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up(): void
    {
        Schema::create('admins', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adfs_id')->nullable();

            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();

            $table->string('password')->nullable();
            $table->boolean('setup_complete')->default(0);

            $table->string('session_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
}
