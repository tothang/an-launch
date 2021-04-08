<?php

namespace App\Http\Controllers\Admin\Queue;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

class ClearController extends Controller
{
    public function __invoke(): JsonResponse
    {
        Redis::connection()->del('queues:' . request('name'));

        return response()->json();
    }
}
