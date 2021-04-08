<?php

namespace App\Modules\Registration\Mail;

use App\Config;
use App\EnvX\Facades\EventInfo;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build(): self
    {
        $lang = $this->user->language ? $this->user->language : User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];
        $brand = strtolower($this->user->brand);

        return $this
            ->subject(__("email.registration_confirmation.$brand.subject", [], $locale))
            ->view("email.$brand.registration-confirmation", [
                'locale' => $locale,
                'user' => $this->user,
                'preview_mail_url' => Config::getFromCache('yale_domain') . '/mail-preview/?email_type=registration-confirmation&token='
                    . Crypt::encryptString($this->user->id),
            ]);
    }
}
