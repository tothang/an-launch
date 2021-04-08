<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateSessionId
{
    public function handle(Login $event): void
    {
        $event->user->update([
            'session_id' => session()->getId()
        ]);
    }
}
