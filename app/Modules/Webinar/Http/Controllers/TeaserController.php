<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeaserController extends Controller
{
    public function index(Request $request): View
    {
        /** @var \App\User */
        $user = $request->user();
        $brand = strtolower($user->brand) ?: config('app.brand');

        $video = config('envx.teaser-videos.' . $brand . '.' . $user->locale);

        return view('webinar::teaser.index', compact('video'));
    }
}
