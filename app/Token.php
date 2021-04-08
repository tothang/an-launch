<?php

namespace App;

use App\EnvX\Concerns\HasConstants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Token extends Model
{
    use HasConstants;

    public const TYPE_AUTH = 'AUTH';
    public const TYPE_VIDEO_TESTER = 'VIDEO_TESTER';
    public const TYPE_RESET_PASSWORD = 'RESET_PASSWORD';

    protected $fillable = [
        'token',
        'type',
        'tokenable_id',
        'tokenable_type',
        'expires_at',
    ];

    protected $dates = [
        'expires_at'
    ];

    public static $length = 32;

    protected static $expiries = [
        self::TYPE_AUTH => 7,
        self::TYPE_VIDEO_TESTER => 7,
        self::TYPE_RESET_PASSWORD => 1,
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::purge();
    }

    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function types(): array
    {
        return self::constByPrefix('TYPE_');
    }

    public static function generate(): string
    {
        return Str::random(self::$length);
    }

    public static function expiryFor(string $type): ?Carbon
    {
        return Arr::has(self::$expiries, $type)
            ? Carbon::now()->addDays(self::$expiries[$type])
            : null;
    }

    public static function fetch(string $token): ?self
    {
        return self::active()->firstWhere('token', $token);
    }

    public static function purge(): void
    {
        self::query()->expired()->delete();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereDate('expires_at', '>', now())
            ->orWhereNull('expires_at');
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->whereDate('expires_at', '<', now())
            ->whereNotNull('expires_at');
    }
}
