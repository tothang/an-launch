<?php

namespace App\Http\Controllers\Auth;

use App\EnvX\Contracts\HandlesAuth;
use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $authHandler;

    public function __construct(HandlesAuth $authHandler)
    {
        $this->middleware(['guest', 'tokenAuth'])->except('logout');

        $this->authHandler = $authHandler;
    }

    public function redirectPath(): string
    {
        return route('index');
    }

    public function showLoginForm(): View
    {
        return view('auth.login', [
            'requiresPassword' => $this->authHandler->requiresPassword(),
        ]);
    }

    public function validateLogin(Request $request): void
    {
        $request->validate(
            $this->authHandler->rules()
        );
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        session()->regenerate();

        $brand = isHyster() ? User::BRAND_HYSTER : User::BRAND_YALE;

        /** @var \App\User|null */
        $user = User::where('email', $request->email)
            ->where('brand', $brand)
            ->first();

        if (is_null($user) && config('envx.auth-handler.creates') && $this->authHandler->shouldCreate()) {
            /** @var \App\User */
            $user = $this->authHandler->create();
        }

        if (is_null($user)) {
            return $this->sendFailedLoginResponse($request);
        }

        if (in_array($user->status, [User::STATUS_NEW, User::STATUS_INVITED])) {
            $this->sendFailedLoginResponseForEmailNotSetPassword($request);
        }

        // if ($user->status == User::STATUS_DECLINED) {
        //     $this->sendFailedLoginResponseForDeclinedStatus($request);
        // }

        $this->authHandler->attemptLogin($user);

        return auth()->check()
            ? $this->sendLoginResponse($request)
            : $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        if (auth()->user()->isFirstLogin()){
            auth()->user()->update([
                'first_login' => 0
            ]);
        }
        $this->guard()->logout();

        if (config('envx.block-concurrent-logins')) {
            $request->session()->invalidate();
        }

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function sendLoginResponse(Request $request): RedirectResponse
    {
        $this->clearLoginAttempts($request);

        /** @var \App\User|null */
        $user = auth()->user();
        $stream = Stream::main();

        if (! is_null($user) && $user->isPasswordCreated() && $user->isFirstLogin()) {
            $user->update([
                'seen_onboarding' => 0
            ]);
            return redirect()->route('confirmation-language');
        }

        $user->update([
            'seen_onboarding' => User::SEEN_ONBOARDING,
            'first_login' => User::DID_LOGIN
        ]);

        if ($user && ($user->isPasswordCreated() || $user->isDeclined())) {
            return redirect()->route('welcome');
        }

        // force redirect to broadcast if stream is live
        if ($stream->is_live) {
            return redirect()->route('webinar');
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponseForDeclinedStatus(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed_login_declined')],
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponseForEmailNotSetPassword(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.email_not_set_password')],
        ]);
    }
}
