<?php

namespace App\Modules\Registration\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ConfirmationController extends Controller
{
    public function __invoke(): View
    {
        return view('registration::confirmation', [
            'registration' => auth()->user()->registration,
        ]);
    }
}
