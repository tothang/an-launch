<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\User|null */
        $user = $request->user();

        if (!is_null($user) && !$user->isPasswordCreated() && !$user->isDeclined()) {
            return redirect()->route('holding');
        }

        $event = [
            'title' => isHyster() ? __('welcome.hyster.title') : __('welcome.yale.title'),
            'date' => __('welcome.date'),
            'time' => isHyster() ? __('welcome.hyster.time') : __('welcome.yale.time'),
            'description' => isHyster() ? __('welcome.hyster.description') : __('welcome.yale.description'),
            'content' => __('welcome.content'),
        ];

        $speaker = [
            'name' => 'STEWART D. MURDOCH',
            'role' => 'Senior Vice President,<br>Managing Director – EMEA',
        ];

        $agenda = [
            'time' => isHyster() ? __('welcome.hyster.time') : __('welcome.yale.time'),
            'title' => '',
        ];

        /** @var \App\User */
        $user = $request->user();
        $brand = strtolower($user->brand) ?: config('app.brand');
        $video = config('envx.teaser-videos.' . $brand . '.' . $user->locale);

        return view('welcome', compact('user', 'event', 'speaker', 'agenda', 'video'));
    }
}
