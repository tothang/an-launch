<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceContentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('experience_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref');
            $table->string('type');
            $table->string('name');
            $table->string('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experience_contents');
    }
}
