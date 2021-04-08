<?php

namespace App\EnvX\Email;

use App\User;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Mailer
{
    private $sent = 0;

    private $email;

    private $tracker;

    private $arguments = [];

    public function handle($selection, string $email): void
    {
        $this->email = $email;

        if ($this->emailTooManyArgs()) {
            throw new FailedToSend(
                'Email has too many constructor args to bulk send, construct with only the user.'
            );
        }

        $users = $this->resolveSelection($selection);

        if ($users->count() < 1) {
            throw new FailedToSend(
                'No emails sent, no users without a log for this mailable were found.'
            );
        }

        $this->isBulkSending($users)
            ? $this->sendToMany($users)
            : $this->actionFor($users->first());
    }

    public function send(Model $user, string $mailable, array $arguments = []): void
    {
        $this->email = $mailable;
        $this->arguments = $arguments;

        $this->actionFor($user);
    }

    private function sendToMany(Collection $users): void
    {
        $users->each(function ($user) {
            $this->actionFor($user);
        });
    }

    private function actionFor(Model $user): void
    {
        Mail::to($user)->send($this->buildEmail($user));

        $this->logFor($user);

        $this->sent++;
    }

    private function isBulkSending(Collection $users): bool
    {
        return $users->count() > 1;
    }

    private function logFor(Model $user): void
    {
        $user->emailLogs()->create([
            'type' => class_basename($this->email),
            'track_token' => $this->tracker,
        ]);
    }

    private function resolveSelection($selection): Collection
    {
        if ($selection instanceof Collection) {
            return $selection;
        }

        return User::findMany($selection);
    }

    public function getSent(): int
    {
        return $this->sent;
    }

    private function emailTooManyArgs(): bool
    {
        try {
            $reflect = (new \ReflectionClass($this->email))->getConstructor();
        } catch (\ReflectionException $e) {
            throw new FailedToSend('Cannot determine emails constructor args.');
        }

        return $reflect->getNumberOfParameters() > 1;
    }

    private function buildEmail(Model $user): Mailable
    {
        array_unshift($this->arguments, $user);

        return (new $this->email(...$this->arguments))->with([
            'tracker' => $this->generateTracker()
        ])->build();
    }

    private function generateTracker(): string
    {
        return $this->tracker = Str::random(32);
    }
}
