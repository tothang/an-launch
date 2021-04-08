<?php

namespace App\EnvX\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait HasConstants
{
    private static function constants(): Collection
    {
        return collect((new \ReflectionClass(static::class))->getConstants());
    }

    public static function constByPrefix(string $prefix): array
    {
        $constants = self::constants()
            ->filter(static function (string $value, string $key) use ($prefix) {
                return Str::startsWith($key, $prefix);
            })
            ->values();

        return $constants->combine($constants)->toArray();
    }
}
