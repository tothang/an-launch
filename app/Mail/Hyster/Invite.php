<?php

namespace App\Mail\Hyster;

use App\Config;
use App\Token;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class Invite extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function recipients(): Builder
    {
        return User::brandHyster()->whereIn('status', [User::STATUS_NEW, User::STATUS_INVITED]);
    }

    public function build(): self
    {
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
            $token = tap($this->user)
                ->update([
                    'setup_complete' => 0,
                    'status' => User::STATUS_INVITED
                ])
                ->generateToken();
        }

        $headerTextFontsize = 115;
        switch ($lang) {
            case User::LANGUAGE_GERMAN:
                $headerTextFontsize = 90;
                break;
        }

        return $this
            ->onQueue(config('envx.queues.emails'))
            ->subject(__('email.invite.hyster.subject', [], $locale))
            ->view('email.hyster.invite', [
                'locale' => $locale,
                'url' => url('/set-password?token=' . $token),
                'preview_mail_url' => url('/mail-preview/?email_type=invite-hyster&token=' . Crypt::encryptString($this->user->id)),
                'headerTextFontsize' => $headerTextFontsize,
            ]);
    }
}
