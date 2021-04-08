<?php

namespace App\Modules\Webinar\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InteractionController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($request->has('view_time')) {
            $user->streamingTimeLogs()->create($request->only('view_time', 'stream_id'));

            return response()->json();
        }

        $user->webinarEvents()->create($request->only('event', 'stream_id'));

        return response()->json();
    }
}
