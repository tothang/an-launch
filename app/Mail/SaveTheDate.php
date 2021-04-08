<?php

namespace App\Mail;

use App\EnvX\Facades\EventInfo;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SaveTheDate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function recipients(): Builder
    {
        return User::query();
    }

    public function build(): self
    {
        $brand = Str::lower($this->user->brand) ?: config('app.brand');

        return $this
            ->onQueue(config('envx.queues.emails'))
            ->subject(EventInfo::emailSubjectPrefix() . ' - Save the date')
            ->view("email.{$brand}.save-the-date", [
                'locale' => $this->user->locale,
            ]);
    }
}
