<?php

namespace App\Mail\Hyster;

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
        return User::brandHyster()->new();
    }

    public function build(): self
    {
        $lang = $this->user->language ? $this->user->language : User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];
        if (isset($this->user->is_preview)){
            $token = Token::where([
                'type' => Token::TYPE_VIDEO_TESTER,
                'tokenable_id' => $this->user->id,
            ])->first()->token;
        }else{
            $token = $this->user->generateToken(Token::TYPE_VIDEO_TESTER);
        }

        return $this
            ->onQueue(config('envx.queues.emails'))
            ->subject(__('email.save_the_date.hyster.subject', [], $locale))
            ->view('email.hyster.save-the-date', [
                'locale' => $locale,
                'url' => url('/teaser?token=' . $token),
                'preview_mail_url' => url('/mail-preview/?email_type=save-the-date-hyster&token=' . Crypt::encryptString($this->user->id)),
            ]);
    }
}
