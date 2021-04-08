<?php

namespace App\Modules\Experience\Http\Controllers\Api;

use App\Modules\Experience\Util\ViewApiManager;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $data = app(ViewApiManager::class, [
            'user' => request()->user(),
            'type' => request()->type
        ])->get();

        return response()->json($data, 200);
    }
}
