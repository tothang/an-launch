<?php

namespace App\EnvX\Event;

use Illuminate\Support\Carbon;

abstract class EventDateTimeFormatter
{
    protected $start;

    protected $end;

    public function __construct(string $start, string $end)
    {
        $this->start = Carbon::parse($start);
        $this->end = Carbon::parse($end);
    }

    public function startRaw(): Carbon
    {
        return $this->start;
    }

    public function endRaw(): Carbon
    {
        return $this->end;
    }

    public function full(): string
    {
        return $this->start->format('l jS F Y - g:ia');
    }
}
