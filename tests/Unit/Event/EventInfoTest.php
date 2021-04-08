<?php

namespace Tests\Unit\Event;

use App\EnvX\Event\EventInfo;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;
use Tests\Util\InteractsWithNonPublicMembers;

class EventInfoTest extends TestCase
{
    use InteractsWithNonPublicMembers, MatchesSnapshots;

    private function eventInfo(): EventInfo
    {
        return EventInfo::consume([
            'client' => 'Example Client',
            'title' => 'Example Event',
            'client-logo' => 'logo.png',

            'start' => '2021-01-01 09:00',
            'end' => '2021-01-01 10:00',

            'contact' => [
                'phone' => '1234567890',
                'email' => [
                    'local' => 'local@example.com',
                ]
            ],
        ]);
    }

    /** @test */
    public function provides_default_email_subject(): void
    {
        self::assertEquals('Example Client - Example Event', $this->eventInfo()->emailSubjectPrefix());
    }

    /** @test */
    public function allows_dynamic_access_to_consumed_data(): void
    {
        $eventInfoObject = $this->eventInfo();

        self::assertEquals('Example Client', $eventInfoObject->client());
        self::assertEquals('logo.png', $eventInfoObject->clientLogo());
        self::assertEquals('1234567890', $eventInfoObject->contact('phone'));
        self::assertEquals('local@example.com', $eventInfoObject->contact('email.local'));
    }

    /** @test */
    public function provides_dynamic_method_calling_to_formatters_and_handler(): void
    {
        $eventInfoObject = $this->eventInfo();

        self::assertEquals($eventInfoObject->dateStart(), $eventInfoObject->date()->start());
        self::assertEquals($eventInfoObject->timeEnd(), $eventInfoObject->time()->end());
        self::assertEquals($eventInfoObject->datesCount(), $eventInfoObject->dates()->count());
    }
}
