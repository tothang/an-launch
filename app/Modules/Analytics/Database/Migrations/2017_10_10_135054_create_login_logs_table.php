<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('login_logs', function(Blueprint $table){
           $table->increments('id');
           $table->integer('user_id')->refrences('id')->on('users')->onDelete('cascade');
           $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
}
