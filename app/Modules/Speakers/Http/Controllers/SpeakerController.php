<?php

namespace App\Modules\Speakers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use App\User;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $lang = optional($user)->language ?: User::LANGUAGE_ENGLISH;
        $locale = User::LOCALE_MAPPING[$lang];

        $presenters = [
            [
                'id' => 1,
                'title' => 'Senior Vice President, <br>Managing Director – EMEA',
                'name' => 'Stewart D. Murdoch ',
                'image' => '/img/speakers/1.png'
            ],
            [
                'id' => 2,
                'title' => 'VP Sales EMEA',
                'name' => 'Ian Melhuish',
                'image' => '/img/speakers/2.png'
            ],
            [
                'id' => 3,
                'title' => 'Director Solutions ',
                'name' => 'Rob O’Donoghue',
                'image' => '/img/speakers/3.png'
            ],
            [
                'id' => 4,
                'title' => 'Director Sales Enablement ',
                'name' => 'Becks Ulyatt',
                'image' => '/img/speakers/4.png'
            ],
            [
                'id' => 5,
                'title' => 'Project Leader N - Series',
                'name' => 'Daniel Heap',
                'image' => '/img/speakers/5.png'
            ],
            [
                'id' => 6,
                'title' => 'Business Development Manager ',
                'name' => 'Tracy Brooks',
                'image' => '/img/speakers/6.png'
            ],
            [
                'id' => 7,
                'title' => 'Plant Manager',
                'name' => 'Jim Downey  Brooks',
                'image' => '/img/speakers/7.png'
            ],
        ];

        $firstThreePresenters = array_slice($presenters, 0, 3);
        $lastPresenters = array_slice($presenters, 3, count($presenters));

        /*foreach (Speaker::sorted()->get() ?? [] as $speaker) {
            $presenters[] = [
                'id' => $speaker->id,
                'title' => $speaker->job_title,
                'name' => $speaker->name,
                'image' => $speaker->image ? '/' . $speaker->image : '/img/speakers/no-image.png'
            ];
        }*/

        $brand = config('app.brand', 'hyster');

        $presenter = [
            'title' => __("presenter.{$brand}.title", [], $locale),
            'date' => __("presenter.{$brand}.date", [], $locale),
            'time' => __("presenter.{$brand}.time", [], $locale),
            'description' => __("presenter.{$brand}.description", [], $locale),
        ];

        return view('speakers::index', compact('presenters', 'presenter', 'firstThreePresenters', 'lastPresenters'));
    }

    public function show(Speaker $speaker)
    {
        return view('speakers::show', compact('speaker'));
    }
}
