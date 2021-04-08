<?php

namespace App\EnvX\Facades;

use App\EnvX\Foundation\ModuleState as BaseModuleState;
use Illuminate\Support\Facades\Facade;

/**
 * @method checkEnabled(string $moduleSlug): bool
 * @method getEnabled(): array
 *
 * @see \App\EnvX\Foundation\ModuleState
 */
class ModuleState extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseModuleState::class;
    }
}
