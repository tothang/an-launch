<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CreatePasswordController extends Controller
{
    public function show(): View
    {
        return view('auth.passwords.create');
    }

    public function store(NewPasswordRequest $request): RedirectResponse
    {
        $user = tap($request->user())
            ->update([
                'password' => bcrypt($request->password),
                'setup_complete' => 1,
            ]);

        optional($user->getToken())->delete();

        return redirect()->route(is_admin() ? 'admin.dashboard' : 'confirmation-language');
    }
}
