<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware(['guest:admin', 'tokenAuth'])->except('logout');
    }

    protected function guard(): StatefulGuard
    {
        return auth('admin');
    }

    public function showForm(): View
    {
        return view('admin.login');
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate(array_merge([
            $this->username() => 'required|email:filter',
            'password' => 'required|string',
        ],  config('envx.recaptcha')
            ? ['g-recaptcha-response' => 'required|captcha']
            : []
        ));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        session()->regenerate();

        if ($this->attemptLogin($request)) {
            $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function redirectTo(): RedirectResponse
    {
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        if (config('envx.block-concurrent-logins')) {
            $request->session()->invalidate();
        }

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    protected function sendLoginResponse(Request $request): RedirectResponse
    {
        $this->clearLoginAttempts($request);

        return redirect()->intended($this->redirectPath());
    }
}
