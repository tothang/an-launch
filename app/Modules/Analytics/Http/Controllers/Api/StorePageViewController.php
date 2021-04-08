<?php

namespace App\Modules\Analytics\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Analytics\Models\PageView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorePageViewController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $pageView = PageView::create([
            'user_id' => auth('api')->user() !== null ? auth('api')->user()->id : 0,
            'url' => $request->track_url,
            'time_spent' => $request->time_spent,
        ]);

        return response()->json([
            'pageView' => $pageView->id,
        ], 200);
    }
}
