<?php

namespace App\Mail;

use App\Admin;
use App\EnvX\Facades\EventInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function build(): self
    {
        return $this
            ->subject(EventInfo::emailSubjectPrefix() . ' - Admin account')
            ->view('email.admin-invite', [
                'token' => $this->admin->generateToken(),
            ]);
    }
}
