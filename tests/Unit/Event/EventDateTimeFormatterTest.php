<?php

namespace Tests\Unit\Event;

use App\EnvX\Event\EventDateTimeFormatter;
use Carbon\Carbon;
use Tests\TestCase;

class EventDateTimeFormatterTest extends TestCase
{
    private function abstract(): object
    {
        Carbon::setTestNow('2020-01-01');

        return $this->getMockForAbstractClass(EventDateTimeFormatter::class, [
            now(), now()->addDays(1)
        ]);
    }

    /** @test */
    public function returns_the_start_date_of_the_event_as_a_carbon_instance(): void
    {
        self::assertEquals(Carbon::parse('2020-01-01'), $this->abstract()->startRaw());
    }

    /** @test */
    public function returns_the_end_date_of_the_event_as_a_carbon_instance(): void
    {
        self::assertEquals(Carbon::parse('2020-01-02'), $this->abstract()->endRaw());
    }

    /** @test */
    public function returns_the_full_start_date_information_for_the_event_formatted(): void
    {
        self::assertEquals('Wednesday 1st January 2020 - 12:00am', $this->abstract()->full());
    }
}
