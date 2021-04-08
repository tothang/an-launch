<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('content_en')->nullable();
            $table->string('content_de')->nullable();
            $table->string('content_fr')->nullable();
            $table->string('content_es')->nullable();
            $table->string('content_it')->nullable();
            $table->string('content_pl')->nullable();
            $table->string('content_ru')->nullable();
            $table->string('content_cs')->nullable();
            $table->string('content_nl')->nullable();
            $table->string('brand')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn([
                'content_en',
                'content_de',
                'content_fr',
                'content_es',
                'content_it',
                'content_pl',
                'content_ru',
                'content_cs',
                'content_nl',
                'brand'
            ]);
        });
    }
}
