<?php

namespace App\Mail;

use App\Admin;
use App\EnvX\Facades\EventInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TempPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $model;

    public $password;

    public $layout;

    public $route;

    public function __construct(Authenticatable $model, string $password)
    {
        $this->model = $model;
        $this->password = $password;
        $this->layout = $this->getLayout();
        $this->route = $this->getRoute();
    }

    public function build(): self
    {
        $this->model->update([
            'setup_complete' => 0,
            'password' => bcrypt($this->password),
        ]);

        return $this->subject(EventInfo::emailSubjectPrefix() . ' - Temporary password')
            ->view('email.temp-password');
    }

    public function getRoute(): string
    {
        if ($this->model instanceof Admin) {
            return route('admin.login');
        }

        return route('login');
    }

    private function getLayout(): string
    {
        return $this->model instanceof Admin ? 'admin-html' : 'html';
    }
}
