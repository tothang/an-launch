<?php

namespace App\Mail\Yale;

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
        return User::brandYale()->whereIn('status', [User::STATUS_NEW, User::STATUS_INVITED]);
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

        return $this
            ->onQueue(config('envx.queues.emails'))
            ->subject(__('email.invite.yale.subject', [], $locale))
            ->view('email.yale.invite', [
                'locale' => $locale,
                'url' => Config::getFromCache('yale_domain') . '/set-password?token=' . $token,
                'preview_mail_url' => Config::getFromCache('yale_domain') . '/mail-preview/?email_type=invite-yale&token='
                    . Crypt::encryptString($this->user->id),
                'user' => $this->user

            ]);
    }
}
