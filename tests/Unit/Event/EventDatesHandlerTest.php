<?php

namespace Tests\Unit\Event;

use App\EnvX\Event\EventDatesHandler;
use Carbon\Carbon;
use Tests\TestCase;

class EventDatesHandlerTest extends TestCase
{
    /** @test */
    public function returns_a_count_of_the_events_days(): void
    {
        Carbon::setTestNow('2020-01-01');
        $handler = (new EventDatesHandler(today(), today()->addDays('2')));

        self::assertEquals(3, $handler->count());
    }

    /** @test */
    public function returns_the_current_day_of_the_event(): void
    {
        Carbon::setTestNow('2020-01-01');
        $handler = (new EventDatesHandler(today(), today()->addDays('2')));

        self::assertEquals(1, $handler->current());

        Carbon::setTestNow('2020-01-02');

        self::assertEquals(2, $handler->current());
    }

    /** @test */
    public function returns_the_carbon_instance_for_the_current_day_of_the_event(): void
    {
        Carbon::setTestNow('2020-01-01');
        $handler = (new EventDatesHandler(today(), today()->addDays('2')));

        self::assertEquals(now(), $handler->currentRaw());

        Carbon::setTestNow('2020-01-02');

        self::assertEquals(now(), $handler->currentRaw());
    }
}
