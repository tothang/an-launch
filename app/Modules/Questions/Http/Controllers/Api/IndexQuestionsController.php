<?php

namespace App\Modules\Questions\Http\Controllers\Api;

use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexQuestionsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $questions = Question::getForLiveChat($request->input('user_id'));

        return response()->json($questions);
    }
}
