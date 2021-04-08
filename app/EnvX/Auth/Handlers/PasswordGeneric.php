<?php

namespace App\EnvX\Auth\Handlers;

use Illuminate\Contracts\Auth\Authenticatable;

class PasswordGeneric extends Password
{
    public function shouldCreate(): bool
    {
        return $this->request->password === config('envx.generic-password');
    }

    public function attemptLogin(Authenticatable $model): void
    {
        if ($this->shouldCreate()) {
            auth()->login($model);
        }
    }
}
