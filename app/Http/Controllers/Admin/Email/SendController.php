<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\EnvX\Email\Mailer;
use App\EnvX\Email\FailedToSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\RedirectResponse;

class SendController extends Controller
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(string $type): RedirectResponse
    {
        $email = config("envx.emails.$type");
        $selected = explode(',', request('selected'));

        if (request()->has('chunk')) {
            $selected = $email::recipients()
                ->withoutEmail($type)
                ->take(request('chunk'))
                ->get();
        }

        try {
            $this->mailer->handle($selected, $email);

            session()->flash('success',
                (app($email) instanceof ShouldQueue ? 'Queuing' : 'Sending') . " {$this->mailer->getSent()} emails..."
            );
        } catch (FailedToSend $e) {
            session()->flash('danger', $e->getMessage());
        }

        return redirect()->route('admin.emails.show', $type);
    }
}
