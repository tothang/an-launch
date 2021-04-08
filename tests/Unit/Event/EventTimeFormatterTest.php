<?php

namespace Tests\Unit\Event;

use App\EnvX\Event\EventTimeFormatter;
use Carbon\Carbon;
use Tests\TestCase;

class EventTimeFormatterTest extends TestCase
{
    private function handler(): EventTimeFormatter
    {
        Carbon::setTestNow('2020-01-01 09:00');

        return (new EventTimeFormatter(now(), now()->addHours(1)));
    }

    /** @test */
    public function returns_the_start_time_of_the_event_formatted(): void
    {
        self::assertEquals('9:00am', $this->handler()->start());
    }

    /** @test */
    public function returns_the_end_time_of_the_event_formatted(): void
    {
        self::assertEquals('10:00am', $this->handler()->end());
    }

    /** @test */
    public function returns_the_timespan_of_the_event_formatted(): void
    {
        self::assertEquals('9:00am - 10:00am', $this->handler()->span());
    }
}
