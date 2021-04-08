<?php

namespace App\EnvX\Auth\Handlers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class Password extends Handler
{
    public function requiresPassword(): bool
    {
        return true;
    }

    public function shouldCreate(): bool
    {
        return false;
    }

    public function attemptLogin(Authenticatable $model): void
    {
        if (Hash::check($this->request->password, $model->getAuthPassword())) {
            parent::attemptLogin($model);
        }
    }
}
