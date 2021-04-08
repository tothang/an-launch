<?php

namespace App\EnvX\Event;

class EventTimeFormatter extends EventDateTimeFormatter
{
    public function start(): string
    {
        return $this->start->format('g:ia');
    }

    public function end(): string
    {
        return $this->end->format('g:ia');
    }

    public function span(): string
    {
        return $this->start() . ' - ' . $this->end();
    }
}
