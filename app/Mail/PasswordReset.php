<?php

namespace App\Mail;

use App\Admin;
use App\Config;
use App\Token;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $model;

    public $token;

    public $layout;

    public $route;

    public function __construct(Authenticatable $model, string $token)
    {
        $this->model = $model;
        $this->token = $token;
        $this->layout = $this->getLayout();
        $this->route = $this->getRoute();
    }

    public function build(): self
    {
        $brand = config('app.brand');
        $tokenModel = null;

        if ($this->model instanceof User) {
            $model = User::where('brand', $brand)
                ->where('email', $this->model->email)
                ->first();

            if ($model) {
                $this->model = $model;
            }

            $tokenModel = Token::where('type', Token::TYPE_RESET_PASSWORD)
                ->where('tokenable_id', $this->model->id)
                ->first();
        }

        $subject = trans("email.password_reset.{$brand}.title", [], $this->model->locale);

        return $this->subject($subject)
            ->view("email.{$brand}.password-reset",[
                'locale' => $this->model->locale,
                'token_login' => $tokenModel ? $tokenModel->token : tap($this->model)
                    ->update(['setup_complete' => 0])
                    ->generateToken(Token::TYPE_RESET_PASSWORD),
                'preview_mail_url' => Config::getFromCache("{$brand}_domain") . '/mail-preview/?email_type=password-reset&token='
                    . Crypt::encryptString($this->model->id),
            ]);
    }

    public function getRoute(): string
    {
        if ($this->model instanceof Admin) {
            $params = ['admin' => 1];
        }

        return route('password.reset', array_merge(
            [$this->token],
            $params ?? []
        ));
    }

    private function getLayout(): string
    {
        return $this->model instanceof Admin ? 'admin-html' : 'html';
    }
}
