<?php

namespace App\Modules\Webinar\Database\Seeds;

use App\Modules\Webinar\Models\Stream;
use App\EnvX\Database\AutoSeed;

class StreamSeeder extends AutoSeed
{
    public function run(): void
    {
        $this
            ->refresh(Stream::class)
            ->then(static function (Stream $model, array $data): void {
                $model->segments()->sync($data['segment_id']);
            });
    }
}
