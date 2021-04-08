<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersTable extends Migration
{
    public function up(): void
    {
        Schema::create('speakers', function(Blueprint $table){
           $table->increments('id');
           $table->integer('day');
           $table->integer('position')->default(1);
           $table->string('name');
           $table->text('bio')->nullable();
           $table->string('job_title')->nullable();
           $table->text('job_description')->nullable();
           $table->string('image')->nullable();
           $table->boolean('questionable')->default(1);
           $table->boolean('agendable')->default(1);
           $table->timestamps();
           $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
}
