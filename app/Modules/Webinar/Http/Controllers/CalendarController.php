<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\EnvX\Facades\EventInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;

class CalendarController extends Controller
{
    public function __invoke(): Response
    {
        $name = EventInfo::title();

        $calendar = Calendar::create()->event(
            Event::create($name)
                ->name($name)
                ->description('Website url: ' . url('/'))
                ->startsAt(EventInfo::dateStartRaw())
                ->endsAt(EventInfo::dateEndRaw())
        );

        return response($calendar->get(), 200, [
            'Content-type' => 'text/calendar',
            'Content-Disposition' => 'attachment; filename="' . $name . '.ics"',
            'charset', 'utf-8',
        ]);
    }
}
