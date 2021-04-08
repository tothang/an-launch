<?php

namespace App\Http\Controllers\Admin\Queue;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Queue;

class StatusController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'onQueue' => Queue::size(request('name')),
        ]);
    }
}
