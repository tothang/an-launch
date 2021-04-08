<?php

namespace App\Http\Controllers\Standalone;

use App\EmailLog;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TrackEmailController extends Controller
{
    public function __invoke(EmailLog $log): BinaryFileResponse
    {
        $log->update(['opened' => true]);

        return response()->file(public_path('img/track/track.gif'));
    }
}
