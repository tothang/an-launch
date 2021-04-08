<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $user = auth()->user();

        if ($user && $user->isDeclined()) {
            return redirect()->route('welcome');
        }

        return redirect()->route(app('login.redirect'));
    }
}
