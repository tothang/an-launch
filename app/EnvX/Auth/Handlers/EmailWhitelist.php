<?php

namespace App\EnvX\Auth\Handlers;

use Illuminate\Support\Str;

class EmailWhitelist extends Email
{
    public function shouldCreate(): bool
    {
        return Str::contains(
            $this->request->email,
            config('envx.auth-handler.whitelist') ?? ['@']
        );
    }
}
