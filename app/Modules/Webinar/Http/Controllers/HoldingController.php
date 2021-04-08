<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class HoldingController extends Controller
{
    public function __invoke(Request $request): View
    {
        /** @var \App\User */
        $user = $request->user();
        $brand = strtolower($user->brand) ?: config('app.brand');

        $video = config('envx.teaser-videos.' . $brand . '.' . $user->locale);
        $highLightSpeaker = Speaker::first();

        return view('webinar::holding.index', [
            'video' => $video,
            'highLightSpeaker' => $highLightSpeaker,
        ]);
    }

    public function download_calendar(Request $request)
    {
        $userSession = $request->user();
        if (!$userSession) {
            return 'No calendar file found!';
        }

        $language = $userSession->language ?? 'English';
        $brand = isYale() ? 'yale' : 'hyster';
        $brandName = isYale() ? 'Yale' : 'Hyster';
        $file = public_path(). '/ics/' . $brand . '/' . $language . '_iCal.ics';
        $fileName = $brandName . ' ' . $language . ' iCal.ics';

        if (!file_exists($file)) {
            return 'No calendar file found!';
        }

        $headers = array(
            'Content-Type: text/calendar',
        );

        return Response::download($file, $fileName, $headers);
    }
}
