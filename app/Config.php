<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getFromCache(string $key): ?string
    {
        return Cache::rememberForever(app_auto_prefix($key), function () use ($key) {
            return optional(self::where('key', $key)->first())->value;
        });
    }

    public static function getBoolFromCache(string $key): ?bool
    {
        return (int) self::getFromCache($key) === 1;
    }
}
