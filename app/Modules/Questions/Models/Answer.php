<?php

namespace App\Modules\Questions\Models;

use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'asked_by',
        'visible',
    ];

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }
}
