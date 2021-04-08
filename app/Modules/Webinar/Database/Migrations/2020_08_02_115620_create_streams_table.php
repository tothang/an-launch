<?php

use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('type')->default(Stream::TYPE_MAIN);
            $table->dateTime('starts_at')->nullable();
            $table->boolean('is_external')->default(0);
            $table->boolean('is_live')->default(0);
            $table->string('stream_link')->nullable();
            $table->string('recording_code')->nullable();
            $table->text('external_link')->nullable();
            $table->json('downloadable_content')->nullable();
            $table->string('theme')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
}
