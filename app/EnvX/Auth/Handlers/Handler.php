<?php

namespace App\EnvX\Auth\Handlers;

use App\EnvX\Contracts\HandlesAuth;
use App\EnvX\User\UserCreator;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

abstract class Handler implements HandlesAuth
{
    protected $request;

    private $creator;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
    }

    public function requiresPassword(): bool
    {
        return false;
    }

    public function shouldCreate(): bool
    {
        return true;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function rules(): array
    {
        return array_merge(
            ['email' => 'required|email:filter|safe'],
            $this->requiresPassword()
                ? ['password' => 'required']
                : [],
            config('envx.recaptcha')
                ? ['g-recaptcha-response' => 'required|captcha']
                : []
        );
    }

    public function attemptLogin(Authenticatable $model): void
    {
        auth()->login($model);
    }

    public function create(): Authenticatable
    {
        return $this->creator->create($this->request->input());
    }
}
