<?php

namespace App\Modules\Notifications\Http\Controllers\Admin;

use App\Modules\Notifications\Http\Requests\NotificationRequest;
use App\Modules\Notifications\Models\Notification;
use App\Http\Controllers\Controller;
use App\Segment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    protected $brand;
    public function __construct()
    {
        $this->brand = isHyster() ? Notification::BRAND_HYSTER : Notification::BRAND_YALE ;
    }

    public function index(): View
    {
        return view('notifications::admin.index', [
            'notifications' => Notification::where('brand',$this->brand)->get(),
        ]);
    }

    public function create(): View
    {
        return view('notifications::admin.create', [
            'segments' => Segment::all()->pluck('name', 'id')->toArray(),
            'types' => Notification::constByPrefix('TYPE'),
        ]);
    }

    public function store(NotificationRequest $request): RedirectResponse
    {
        Notification::create(array_merge(
            $request->input(),
            [
                'send_at' => Carbon::parse($request->send_at),
                'brand' => $this->brand,
            ]
        ))->segments()->sync($request->segments);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification created!');
    }

    public function edit(Notification $notification): View
    {
        return view('notifications::admin.edit', [
            'notification' => $notification,
            'segments' => Segment::all()->pluck('name', 'id')->toArray(),
            'types' => Notification::constByPrefix('TYPE'),
        ]);
    }

    public function update(NotificationRequest $request, Notification $notification): RedirectResponse
    {
        tap($notification)->update(array_merge(
            $request->input(),
            ['send_at' => Carbon::parse($request->send_at)]
        ))->segments()->sync($request->segments);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification updated!');
    }

    public function destroy(Notification $notification): RedirectResponse
    {
        $notification->delete();

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification deleted!');
    }
}
