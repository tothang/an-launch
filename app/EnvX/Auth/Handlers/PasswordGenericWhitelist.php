<?php

namespace App\EnvX\Auth\Handlers;

use Illuminate\Support\Str;

class PasswordGenericWhitelist extends PasswordGeneric
{
    public function shouldCreate(): bool
    {
        return parent::shouldCreate()
            && Str::contains(
                $this->request->email,
                config('envx.auth-handler.whitelist') ?? ['@']
            );
    }
}
