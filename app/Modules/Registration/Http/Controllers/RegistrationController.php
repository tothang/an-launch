<?php

namespace App\Modules\Registration\Http\Controllers;

use App\EnvX\Email\Mailer;
use App\Http\Controllers\Controller;
use App\Modules\Registration\Http\Requests\RegistrationRequest;
use App\Modules\Registration\Mail\RegistrationConfirmation;
use App\Modules\Registration\Models\UserRegistration;
use App\Modules\Webinar\Models\Stream;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function index(): View
    {
        $lang = auth()->user()->getLocaleAttribute();
        return view('registration::index', [
            'countries' => is_array(config('envx.countries.'.$lang)) ? config('envx.countries.'.$lang) : config('envx.countries.en'),
            'registration' => auth()->user()->registration,
            'user' => auth()->user(),
            'titles' => User::TITLES,
        ]);
    }

    public function update(RegistrationRequest $request, UserRegistration $registration): RedirectResponse
    {
        $data = $request->input();
        $stream = Stream::main();
        $user = User::find($registration->user_id);
        $data['status'] = User::STATUS_REGISTERED;
        $user->update($data);

        $this->mailer->send(
            $registration->register($request->input())->user,
            RegistrationConfirmation::class
        );
        if ($stream->is_live && !$user->seenOnBoarding() &&  $user->isFirstLogin()){
            return redirect()->route('onboarding.index');
        }

        return redirect()->route('holding');
    }

    public function declineInvitation()
    {
        /** @var \App\User|null */
        $user = auth()->user();
        $lang = optional($user)->language ?: User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];

        if ($user && $user->isDeclined()) {
            return redirect()->route('welcome');
        }

        $brand = config('app.brand', 'hyster');
        $cantMakeFontsize = 66;

        switch ($lang) {
            case User::LANGUAGE_DUTCH:
            case User::LANGUAGE_GERMAN:
                $cantMakeFontsize = 60;
                break;
            case User::LANGUAGE_FRENCH:
                $cantMakeFontsize = 40;
                break;
        }

        return view('registration::declined', [
            'registration' => $user->registration,
            'user' => $user,
            'titles' => User::TITLES,
            'brand' => $brand,
            'locale' => $locale,
            'cantMakeFontsize' => $cantMakeFontsize,
        ]);
    }

    public function postDeclineInvitation(Request $request)
    {
        /** @var \App\User */
        $user = $request->user();

        $data = $request->input();
        $data['status'] = User::STATUS_DECLINED;
        $user->update($data);

        return response()->json([
            'success' => true
        ]);
    }
}
