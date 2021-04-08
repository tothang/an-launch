<?php

namespace App\Modules\Webinar\Http\Traits;

use App\Modules\Webinar\Models\Stream;
use App\Modules\Webinar\Models\StreamingTimeLog;
use App\Modules\Webinar\Models\WebinarEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithWebinar
{
    public function webinarEvents(): HasMany
    {
        return $this->HasMany(WebinarEvent::class);
    }

    public function streamingTimeLogs(): HasMany
    {
        return $this->hasMany(StreamingTimeLog::class);
    }

    public function startedStream(Stream $stream): bool
    {
        return $this->webinarEvents()
            ->where('event', WebinarEvent::EVENT_STARTED_STREAM)
            ->where('stream_id', $stream->id)
            ->exists();
    }

    public function finishedStream(Stream $stream): bool
    {
        return $this->webinarEvents()
            ->where('event', WebinarEvent::EVENT_FINISHED_STREAM)
            ->where('stream_id', $stream->id)
            ->exists();
    }

    public function getTotalStreamTime(?Stream $stream = null): string
    {
        $records = $this->streamingTimeLogs()
            ->when($stream, static function (Builder $query) use ($stream): Builder {
                return $query->where('stream_id', $stream->id);
            })
            ->pluck('view_time')
            ->toArray();

        return substr(array_sum($records) / 60, 0, 5);
    }
}
