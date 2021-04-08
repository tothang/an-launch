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
        return User::brandYale()->new();
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
            ->subject(__('email.save_the_date.yale.subject', [], $locale))
            ->view('email.yale.save-the-date', [
                'locale' => $locale,
                'view_video_trailer_button_width' => $this->getViewVideoTrailerButtonWidth($lang),
                'url' => url('/teaser?token=' . $token),
                'preview_mail_url' => url('/mail-preview/?email_type=save-the-date-yale&token=' . Crypt::encryptString($this->user->id)),
            ]);
    }

    private function getViewVideoTrailerButtonWidth(string $lang): string
    {
        $return = 'auto';
        switch ($lang) {
            case User::LANGUAGE_ENGLISH:
                $return = '250px';
                break;
            case User::LANGUAGE_DUTCH:
                $return = '350px';
                break;
            case User::LANGUAGE_FRENCH:
                $return = '390px';
                break;
            case User::LANGUAGE_GERMAN:
                $return = '330px';
                break;
            case User::LANGUAGE_ITALIAN:
                $return = '270px';
                break;
            case User::LANGUAGE_POLISH:
                $return = '290px';
                break;
            case User::LANGUAGE_SPANISH:
                $return = '310px';
                break;
            case User::LANGUAGE_CZECH:
                $return = '300px';
                break;
            case User::LANGUAGE_RUSSIAN:
                $return = '400px';
                break;
        }

        return $return;
    }
}
