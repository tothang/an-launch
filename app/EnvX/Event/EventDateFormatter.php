<?php

namespace App\EnvX\Event;

class EventDateFormatter extends EventDateTimeFormatter
{
    public function start(): string
    {
        return $this->start->format('l jS F Y');
    }

    public function end(): string
    {
        return $this->end->format('l jS F Y');
    }

    public function forCountdown(): string
    {
        return $this->start->toDateTimeLocalString();
    }
}
