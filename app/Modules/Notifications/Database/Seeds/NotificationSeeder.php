<?php

namespace App\Modules\Notifications\Database\Seeds;

use App\EnvX\Database\AutoSeed;
use App\Modules\Notifications\Models\Notification;

class NotificationSeeder extends AutoSeed
{
    public function run(): void
    {
        $this->refresh(Notification::class)
            ->then(static function (Notification $notification, array $data): void {
                $notification->segments()->sync($data['segment_id']);
            });
    }
}
