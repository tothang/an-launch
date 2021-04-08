<?php

namespace App\Modules\Experience\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        return view('experience::landing.index', [
            'registered' => $user->isRegistered(),
            'attending' => $user->isAttending(),
        ]);
    }
}
