<?php

namespace App\Modules\Webinar\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StreamingTimeLog extends Model
{
    protected $table = 'streaming_time_logs';

    protected $fillable = [
        'user_id',
        'view_time',
        'stream_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stream(): HasOne
    {
        return $this->hasOne(Stream::class);
    }
}
