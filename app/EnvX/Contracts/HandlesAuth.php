<?php

namespace App\EnvX\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface HandlesAuth
{
    public const HANDLER_AFFIX = '-handler';

    public const EMAIL_HANDLER                      = 'email' . self::HANDLER_AFFIX;
    public const EMAIL_WHITELIST_HANDLER            = 'email-whitelist' . self::HANDLER_AFFIX;
    public const PASSWORD_HANDLER                   = 'password' . self::HANDLER_AFFIX;
    public const PASSWORD_GENERIC_HANDLER           = 'password-generic' . self::HANDLER_AFFIX;
    public const PASSWORD_GENERIC_WHITELIST_HANDLER = 'password-generic-whitelist' . self::HANDLER_AFFIX;

    public const HANDLERS = [
        self::EMAIL_HANDLER,
        self::EMAIL_WHITELIST_HANDLER,
        self::PASSWORD_HANDLER,
        self::PASSWORD_GENERIC_HANDLER,
        self::PASSWORD_GENERIC_WHITELIST_HANDLER,
    ];

    public function requiresPassword(): bool;

    public function shouldCreate(): bool;

    public function rules(): array;

    public function attemptLogin(Authenticatable $model): void;

    public function create(): Authenticatable;
}
