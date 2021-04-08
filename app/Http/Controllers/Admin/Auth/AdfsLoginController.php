<?php

namespace App\Http\Controllers\Admin\Auth;

use App\EnvX\Admin\AdminCreator;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AdfsLoginController
{
    private $creator;

    public function __construct(AdminCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(): RedirectResponse
    {
        try {
            $adfsUser = Socialite::driver('adfs')->user();
        } catch (ClientException $exception) {
            return redirect('/')->with('error', 'Unable to login. Please try again later.');
        }

        auth('admin')->login(
            $this->creator->handleAdfs($adfsUser), false
        );

        return redirect()->route('admin.dashboard');
    }
}
