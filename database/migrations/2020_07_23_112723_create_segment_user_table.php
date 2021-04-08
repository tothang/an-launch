<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentUserTable extends Migration
{
    public function up(): void
    {
        Schema::create('segment_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('segment_id')->references('id')->on('segments')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segment_user');
    }
}
