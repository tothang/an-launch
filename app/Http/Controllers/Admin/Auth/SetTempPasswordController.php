<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\TempPassword;
use App\EnvX\Email\Mailer;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SetTempPasswordController extends Controller
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(Request $request, string $modelType, int $id): RedirectResponse
    {
        $model = User::find($id);
        $password = config('envx.temp-password');

        if ($modelType === 'Admin') {
            $model = Admin::find($id);
            $password = config('envx.temp-password-admin');
        }

        if ($model === null || $password === null) {
            return back()->with('error', 'Could not find password or model');
        }

        $this->mailer->send($model, TempPassword::class, [
            $password
        ]);

        return back()->with('success', 'Temp password set!');
    }
}
