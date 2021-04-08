<?php

namespace App\Modules\Experience\Http\Controllers;

use App\Modules\Webinar\Models\Stream;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function __invoke(): View
    {
        $segments = auth()->user()->segments;
        $futureStreams = Stream::upcoming($segments->pluck('name')->toArray());

        Stream::breakoutCodes()->each(function (string $code) use ($futureStreams, &$upcomingBreakouts): void {
            $nextBreakout = $futureStreams->where('code', $code)->first();

            $upcomingBreakouts[$code] = $nextBreakout ? [
                'name' => $nextBreakout->name,
                'time' => $nextBreakout->time,
            ] : null;
        });

        return view('experience::index', [
            'segments' => json_encode($segments->pluck('slug')->toArray() ?: []),
            'upcomingBreakouts' => json_encode($upcomingBreakouts ?: []),
        ]);
    }
}
