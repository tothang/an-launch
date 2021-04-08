<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectTo(): string
    {
        return request()->has('admin')
            ? route('admin.dashboard')
            : route('index');
    }

    protected function guard(): StatefulGuard
    {
        return auth()->guard(
            request()->has('admin') ? 'admin' : null
        );
    }

    public function broker(): PasswordBroker
    {
        return Password::broker(
            request()->has('admin') ? 'admins' : null
        );
    }

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/^((?=.*[A-Z])(?=.*[a-z])(?=.*\d)|(?=.*[a-z])(?=.*\d)(?=.*[\W])|(?=.*[A-Z])(?=.*\d)(?=.*[\W])|(?=.*[A-Z])(?=.*[a-z])(?=.*[\W])).+$/',
                'confirmed',
            ],
        ];
    }
}
