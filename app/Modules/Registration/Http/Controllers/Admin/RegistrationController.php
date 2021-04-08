<?php

namespace App\Modules\Registration\Http\Controllers\Admin;

use App\EnvX\Email\Mailer;
use App\Http\Controllers\Controller;
use App\Modules\Registration\Http\Requests\Admin\RegistrationRequest;
use App\Modules\Registration\Mail\RegistrationConfirmation;
use App\Modules\Registration\Models\UserRegistration;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function edit(User $user): View
    {
        return view('registration::admin.edit', [
            'registration' => $user->registration,
        ]);
    }

    public function update(RegistrationRequest $request, UserRegistration $registration): RedirectResponse
    {
        $registration->update($request->input());

        if ($request->has('register')) {
            $registration->register();

            if ($request->has('confirmation')) {
                $this->mailer->send($registration->user, RegistrationConfirmation::class);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Registration updated!');
    }

    public function destroy(UserRegistration $registration): RedirectResponse
    {
        $registration->reset();

        return redirect()->route('admin.users.index')
            ->with('success', 'Registration reset!');
    }
}
