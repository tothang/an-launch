<?php

namespace App\Modules\Experience\Http\Controllers\Api;

use App\Modules\Experience\Util\DataApiManager;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $data = app(DataApiManager::class, [
            'user' => request()->user(),
            'type' => request()->type
        ])->get();

        return response()->json($data, 200);
    }
}
