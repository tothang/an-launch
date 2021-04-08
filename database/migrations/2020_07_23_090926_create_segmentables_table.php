<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentablesTable extends Migration
{
    public function up(): void
    {
        Schema::create('segmentables', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('segment_id');
            $table->morphs('segmentable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segmentables');
    }
}
