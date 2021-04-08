<?php

namespace Tests\Util;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

trait CreatesTestModel
{
    private function bootTable(): void
    {
        Schema::create('test', static function (Blueprint $table): void {
            $table->unsignedBigInteger('id');
            $table->timestamps();
        });
    }

    public function bootTestModel(): TestModel
    {
        $this->bootTable();

        return TestModel::create(['id' => 1]);
    }

    public function bootTestModels(int $quantity): Collection
    {
        $this->bootTable();

        for($i = 0; $i < $quantity; $i++) {
            TestModel::create(['id' => $i]);
        }

        return TestModel::all();
    }
}
