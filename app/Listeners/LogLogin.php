<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Login;

class LogLogin
{
    public function handle(Login $event): void
    {
        if ($event->user instanceof User) {
            $event->user->loginLogs()->create();
        }
    }
}
