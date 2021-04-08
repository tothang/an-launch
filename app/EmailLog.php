<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailLog extends Model
{
    protected $fillable = [
        'type',
        'message',
        'track_token',
        'opened',
    ];

    public function emailable(): BelongsTo
    {
        return $this->morphTo();
    }
}
