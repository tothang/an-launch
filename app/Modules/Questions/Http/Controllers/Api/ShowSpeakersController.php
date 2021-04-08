<?php

namespace App\Modules\Questions\Http\Controllers\Api;

use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowSpeakersController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(Speaker::questionable()->get('name'));
    }
}
