<?php

namespace App\EnvX\Event;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EventDatesHandler
{
    private $dates;

    public function __construct(string $start, string $end)
    {
        $this->dates = collect(CarbonPeriod::create($start, $end)->toArray());
    }

    public function count(): int
    {
        return $this->dates->count();
    }

    public function current(): ?int
    {
        if ($this->currentRaw() === null) {
            return null;
        }

        return $this->dates->search($this->currentRaw()) + 1;
    }

    public function currentRaw(): ?Carbon
    {
        return $this->dates->filter(static function (Carbon $date): bool {
            return $date->isSameDay(today());
        })->first();
    }
}
