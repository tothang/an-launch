<?php

namespace App\Modules\Webinar\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\View\View;

class EngagementController extends Controller
{
    public function index(): View
    {
        return view('webinar::admin.streams.select', [
            'route' => 'admin.engagement.show',
            'reference' => 'user engagement',
        ]);
    }

    public function show(Stream $stream): View
    {
        return view('webinar::admin.engagement.index', [
            'stream' => $stream,
            'users' => User::with('webinarEvents')->get(),
        ]);
    }
}
