<?php

namespace App\Modules\Notifications\Http\Controllers\Admin;

use App\Modules\Notifications\Events\SendNotification;
use App\Modules\Notifications\Models\Notification;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class SendNotificationController extends Controller
{
    public function __invoke(Notification $notification): RedirectResponse
    {
        if ($notification->isGlobal()) {
            event(new SendNotification($notification));
        } else {
            $notification->segments()->each(function ($segment) use ($notification) {
                event(new SendNotification($notification, $segment->name));
            });
        }

        $notification->sent_at = Carbon::now();
        $notification->save();

        return back()->with('success', 'Notification sent!');
    }
}
