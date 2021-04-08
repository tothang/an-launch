<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker(): PasswordBroker
    {
        return Password::broker(request()->has('admin') ? 'admins' : null);
    }

    public function showLinkRequestForm(): View
    {
        return view('auth.passwords.email')
            ->with(request()->only('admin'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('brand', ucfirst(config('app.brand')))
            ->where('email', $request->get('email'))
            ->first();

        if ($user || request()->has('admin')) {
            $this->broker()->sendResetLink($this->credentials($request));
        }

        return $this->sendResetLinkResponse($request, Password::RESET_LINK_SENT);
    }
}
