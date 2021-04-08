<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use Illuminate\Http\JsonResponse;

class PollAndQuizScoreController extends Controller
{
    public function show(): JsonResponse
    {
        $questions = PollAndQuizQuestion::all()->count();
        $correct = PollAndQuizResponse::correctAnswersForUser(request()->user_id)->count();

        return response()->json([
            'holdingMessage' => "You scored {$correct} out of {$questions}"
        ]);
    }
}
