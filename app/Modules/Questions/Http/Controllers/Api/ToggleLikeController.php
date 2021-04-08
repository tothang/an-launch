<?php

namespace App\Modules\Questions\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Questions\Events\UpdateLikes;
use App\Modules\Questions\Models\Question;
use App\Modules\Questions\Models\QuestionLikes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ToggleLikeController extends Controller
{
    public function __invoke(Request $request, Question $question): JsonResponse
    {
        $like = $question->likes()->byUser($request->input('user_id'))->first();

        $like ? $like->delete() : $question->likes()->create($request->only('user_id'));
        event(new UpdateLikes($question));

        return response()->json(['liked' => !$like]);
    }
}
