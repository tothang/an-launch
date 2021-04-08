<?php

namespace Tests\Unit\Concerns\Yale;

use App\Mail\Yale\Invite;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Util\CreatesTestModel;
use Tests\Util\TestModel;

class EmailableTest extends TestCase
{
    use RefreshDatabase, CreatesTestModel;

    /** @test */
    public function checks_if_an_inheritor_has_been_emailed_within_the_last_24_hours(): void
    {
        $inheritor = $this->bootTestModel();

        Carbon::setTestNow('2020-01-01 08:00');
        $inheritor->emailLogs()->create(['type' => 'App\Mail\Example']);
        Carbon::setTestNow('2020-01-02 09:00');

        self::assertFalse($inheritor->recentlyEmailed());

        Carbon::setTestNow('2020-01-10 09:00');
        $inheritor->emailLogs()->create(['type' => 'App\Mail\Example']);
        Carbon::setTestNow('2020-01-11 08:00');

        self::assertTrue($inheritor->recentlyEmailed());
    }

    /** @test */
    public function scopes_to_include_records_that_have_an_invitation_email_log(): void
    {
        $model = $this->bootTestModels(2)->first();

        self::assertEquals(0, TestModel::invited()->count());

        $model->emailLogs()->create(['type' => class_basename(Invite::class)]);

        self::assertEquals(1, TestModel::invited()->count());
    }

    /** @test */
    public function scopes_to_include_records_with_a_given_email_type_logged(): void
    {
        $model = $this->bootTestModels(3)->first();
        $email = class_basename(Invite::class);

        self::assertEquals(0, TestModel::withEmail($email)->count());

        $model->emailLogs()->create(['type' => $email]);

        self::assertEquals(1, TestModel::withEmail($email)->count());
    }

    /** @test */
    public function scopes_to_include_records_without_a_given_email_type_logged(): void
    {
        $model = $this->bootTestModels(3)->first();
        $email = class_basename(Invite::class);

        self::assertEquals(3, TestModel::withoutEmail($email)->count());

        $model->emailLogs()->create(['type' => $email]);

        self::assertEquals(2, TestModel::withoutEmail($email)->count());
    }
}
