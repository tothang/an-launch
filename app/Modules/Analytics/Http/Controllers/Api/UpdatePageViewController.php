<?php

namespace App\Modules\Analytics\Http\Controllers\Api;

use App\Modules\Analytics\Jobs\UpdatePageViewTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdatePageViewController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        UpdatePageViewTime::dispatch(
            $request->page_view,
            $request->time_spent
        )->onQueue(config('envx.queues.analytics'));

        return response()->json([], 200);
    }
}

