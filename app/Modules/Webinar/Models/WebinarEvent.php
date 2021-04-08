<?php

namespace App\Modules\Webinar\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WebinarEvent extends Model
{
    public const EVENT_STARTED_STREAM = 'started_stream';
    public const EVENT_FINISHED_STREAM = 'finished_stream';

    protected $fillable = [
        'user_id',
        'event',
        'stream_id',
    ];

    public static function streamFinished(Stream $stream): bool
    {
        return self::where('event', self::EVENT_FINISHED_STREAM)
            ->where('stream_id', $stream->id)->exists();
    }

    public function scopeStarted(Builder $query): Builder
    {
        return $query->where('event', self::EVENT_STARTED_STREAM);
    }

    public function scopeFinished(Builder $query): Builder
    {
        return $query->where('event', self::EVENT_FINISHED_STREAM);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stream(): HasOne
    {
        return $this->hasOne(Stream::class);
    }
}
