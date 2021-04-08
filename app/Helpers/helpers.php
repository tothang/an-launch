<?php

use App\EnvX\Facades\ModuleState;
use Illuminate\Support\Str;

if (! function_exists('is_root')) {
    function is_root(): ?bool {
        return is_admin() && auth('admin')->user()->hasRole('root');
    }
}

if (! function_exists('is_admin')) {
    function is_admin(): bool {
        return auth('admin')->check();
    }
}

if (! function_exists('module_enabled')) {
    function module_enabled(string $moduleSlug): bool {
        return ModuleState::checkEnabled($moduleSlug);
    }
}

if (! function_exists('app_auto_prefix')) {
    function app_auto_prefix(string $for): string {
        return strtolower(
            str_replace([' ', '-'], '_',
                (config('app.name') . '_' . config('app.env') . '_' . $for)
            )
        );
    }
}

if (! function_exists('display_classname')) {
    function display_classname(string $class): string {
        return ucfirst(Str::snake(class_basename($class), ' '));
    }
}

if (! function_exists('s3asset')) {
    function s3asset(?string $path = null): string {
        if (config('app.env') === 'local') {
            return url($path ?? '/');
        }

        return config('envx.s3-asset-path') . $path;
    }
}

if (! function_exists('isHyster')) {
    function isHyster(): bool {
        return config('app.brand') === 'hyster';
    }
}

if (! function_exists('isYale')) {
    function isYale(): bool {
        return config('app.brand') === 'yale';
    }
}

if (! function_exists('isRegisteredDelegate')) {
    function isRegisteredDelegate(): bool {
        /** @var \App\User|null */
        $user = auth()->user();
        return $user && $user->isRegistered();
    }
}

if (! function_exists('isPasswordCreated')) {
    function isPasswordCreated(): bool {
        /** @var \App\User|null */
        $user = auth()->user();
        return $user && $user->isPasswordCreated();
    }
}

if (! function_exists('getBrand')) {
    function getBrand(): string {
        return config('app.brand');
    }
}