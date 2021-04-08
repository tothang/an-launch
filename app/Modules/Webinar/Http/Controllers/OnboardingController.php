<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function index(): View
    {
        return isHyster() ? view('webinar::onboarding.hyster.index') : view('webinar::onboarding.yale.index');
    }

    public function update(): RedirectResponse
    {
        auth()->user()->update(['seen_onboarding' => 1]);

        return redirect()->route('webinar');
    }
}
