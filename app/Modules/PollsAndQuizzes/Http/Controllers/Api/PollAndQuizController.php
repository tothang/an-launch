<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PollAndQuizController extends Controller
{
    public function show(): JsonResponse
    {
        $question = PollAndQuizQuestion::whereHas('quiz', function ($query) {
            $query->where('stream_id', request()->stream_id);
        })->activeAndUnanswered(auth('api')->user()->id)->first();

        if ($question === null) {
            return response()->json([
                'holdingMessage' => 'Please wait for the next question.'
            ]);
        }

        return response()->json([
            'questionId' => $question->id,
            'question' => $question->title,
            'answers' => $question->answers()->get(['id', 'value']),
            'multipleAnswers' => $question->multipleAnswers()
        ]);
    }

    public function store(Request $request, int $questionId): JsonResponse
    {
        foreach ($request->responses as $response) {
            PollAndQuizResponse::create([
                'user_id' => auth('api')->user()->id,
                'poll_and_quiz_question_id' => $questionId,
                'poll_and_quiz_answer_id' => $response
            ]);
        }

        return response()->json([
            'holding_message' => 'Thank you for your answer.'
        ]);
    }
}
