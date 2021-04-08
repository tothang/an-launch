<?php

namespace App\Mail\Hyster;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class DeclineInvitation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var \App\User */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lang = $this->user->language ?: User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];

        return $this
            ->subject(__('email.decline_invitation.hyster.subject', [], $locale))
            ->view('email.hyster.decline-invitation', [
                'locale' => $locale,
                'preview_mail_url' => url('/mail-preview/?email_type=decline-invitation-hyster&token=' . Crypt::encryptString($this->user->id)),
        ]);
    }
}
