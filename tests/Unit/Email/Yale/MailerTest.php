<?php

namespace Tests\Unit\Email\Yale;

use App\EmailLog;
use App\EnvX\Email\FailedToSend;
use App\EnvX\Email\Mailer;
use App\Mail\TempPassword;
use App\Mail\Yale\Invite;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Tests\Util\InteractsWithNonPublicMembers;

class MailerTest extends TestCase
{
    use RefreshDatabase, InteractsWithNonPublicMembers;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
    }

    private function mailer(): Mailer
    {
        return (new Mailer);
    }

    /** @test */
    public function sends_a_mailable_to_a_given_emailable_model(): void
    {
        $user = factory(User::class)->create();

        $this->mailer()->send($user, TempPassword::class, ['password']);

        Mail::assertSent(TempPassword::class, function ($mail) use ($user) {
            return $mail->password === 'password' && $mail->model->email === $user->email;
        });
    }

    /** @test */
    public function logs_the_email_send_for_the_user(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create();
        $mailer = $this->mailer();

        self::assertEquals(0, $mailer->getSent());
        self::assertEquals(0, EmailLog::count());

        $mailer->send($user, Invite::class);

        self::assertEquals(1, $mailer->getSent());
        self::assertEquals(1, EmailLog::count());

        self::assertEquals($user->email, EmailLog::first()->emailable->email);
        self::assertEquals(class_basename(Invite::class), EmailLog::first()->type);
    }

    /** @test */
    public function determines_if_bulk_sending_from_the_count_of_models_given(): void
    {
        self::assertFalse($this->callNonPublicMethod(
            $this->mailer(), 'isBulkSending', [
                collect([1])
            ]
        ));

        self::assertTrue($this->callNonPublicMethod(
            $this->mailer(), 'isBulkSending', [
                collect([1, 2])
            ]
        ));
    }

    /** @test */
    public function normalises_the_data_structure_it_is_handling(): void
    {
        self::assertInstanceOf(
            Collection::class,
            $this->callNonPublicMethod($this->mailer(), 'resolveSelection', [1,2,3])
        );

        self::assertInstanceOf(
            Collection::class,
            $this->callNonPublicMethod($this->mailer(), 'resolveSelection', [collect([1,2,3])])
        );
    }

    /** @test */
    public function constructs_the_mailable_object_with_the_model_as_the_first_arg(): void
    {
        $mailer = $this->mailer();
        $user = factory(User::class)->create();

        $this->setNonPublicProperty($mailer, 'email', TempPassword::class);
        $this->setNonPublicProperty($mailer, 'arguments', ['TheTempPassword']);

        $mailable = $this->callNonPublicMethod($mailer, 'buildEmail', [$user]);

        self::assertEquals($mailable->model, $user);
        self::assertEquals($mailable->password, 'TheTempPassword');
    }

    /** @test */
    public function throws_exception_when_trying_to_bulk_send_mailable_with_more_than_one_constructor_argument(): void
    {
        $this->markTestIncomplete();
        $user = factory(User::class)->create();

        $this->mailer()->handle([$user->id], Invite::class);

        $this->expectException(FailedToSend::class);
        $this->expectExceptionMessage('Email has too many constructor args to bulk send, construct with only the user.');

        $this->mailer()->handle([$user->id], TempPassword::class);
    }

    /** @test */
    public function throws_exception_when_trying_to_bulk_send_an_email_with_no_valid_recipients(): void
    {
        $this->expectException(FailedToSend::class);
        $this->expectExceptionMessage('No emails sent, no users without a log for this mailable were found.');

        self::assertEquals(0, User::count());

        $this->mailer()->handle([], Invite::class);
        $this->mailer()->handle([1], Invite::class);
    }
}
