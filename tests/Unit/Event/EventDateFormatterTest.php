<?php

namespace Tests\Unit\Event;

use App\EnvX\Event\EventDateFormatter;
use Carbon\Carbon;
use Tests\TestCase;

class EventDateFormatterTest extends TestCase
{
    private function handler(): EventDateFormatter
    {
        Carbon::setTestNow('2020-01-01');

        return (new EventDateFormatter(now(), now()->addDays(1)));
    }

    /** @test */
    public function returns_the_start_date_of_the_event_formatted(): void
    {
        self::assertEquals('Wednesday 1st January 2020', $this->handler()->start());
    }

    /** @test */
    public function returns_the_end_date_of_the_event_formatted(): void
    {
        self::assertEquals('Thursday 2nd January 2020', $this->handler()->end());
    }

    /** @test */
    public function returns_the_start_date_of_the_event_formatted_for_the_countdown_timer(): void
    {
        self::assertEquals('2020-01-01T00:00:00', $this->handler()->forCountdown());
    }
}
