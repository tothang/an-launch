<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('streams', function (Blueprint $table) {
            $table->string('embed_type')->nullable();
            $table->string('embed_code_en')->nullable();
            $table->string('embed_code_de')->nullable();
            $table->string('embed_code_fr')->nullable();
            $table->string('embed_code_es')->nullable();
            $table->string('embed_code_it')->nullable();
            $table->string('embed_code_pl')->nullable();
            $table->string('embed_code_ru')->nullable();
            $table->string('embed_code_cs')->nullable();
            $table->string('embed_code_nl')->nullable();
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
        Schema::table('streams', function (Blueprint $table) {
            $table->dropColumn([
                'embed_type',
                'embed_code_en',
                'embed_code_de',
                'embed_code_fr',
                'embed_code_es',
                'embed_code_it',
                'embed_code_pl',
                'embed_code_ru',
                'embed_code_cs',
                'embed_code_nl'
            ]);
        });
    }
}
