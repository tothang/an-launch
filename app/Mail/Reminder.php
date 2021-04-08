<?php

namespace App\Mail;

use App\Config;
use App\EnvX\Facades\EventInfo;
use App\Token;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class Reminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function recipients(): Builder
    {
        return User::notRegistered();
    }

    public function build(): self
    {
        $brand = config('app.brand') ?? '';
        $lang = $this->user->language ? $this->user->language : User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];

        $currentRoute = Route::getFacadeRoot()->current();
        $authUserToken = $token = Token::where([
            'type' => Token::TYPE_AUTH,
            'tokenable_id' => $this->user->id,
        ])->first();

        if ($currentRoute && $currentRoute->uri() === 'mail-preview' && $authUserToken) {
            $token = $authUserToken->token;
        } else {

            if (in_array($this->user->status, [User::STATUS_INVITED, User::STATUS_PASSWORD_CREATED])) {
                $token = $this->user->generateToken();
            } else {
                $token = tap($this->user)
                    ->update([
                        'status' => User::STATUS_INVITED
                    ])
                    ->generateToken();
            }
        }

        if ($this->user->status === User::STATUS_INVITED) {
            $url = url('/set-password?token=' . $token);
        } else {
            $url = url('/login');
        }

        return $this
            ->onQueue(config('envx.queues.emails'))
            ->subject('Reminders Email')
            ->view('email.'.$brand.'.reminder', [
                'locale' => $locale,
                'url' => $url,
                'preview_mail_url' => url('/mail-preview/?email_type=reminder&token='
                    . Crypt::encryptString($this->user->id)),
            ]);
    }
}
