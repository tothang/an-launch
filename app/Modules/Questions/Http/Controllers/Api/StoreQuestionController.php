<?php

namespace App\Modules\Questions\Http\Controllers\Api;

use App\Modules\Questions\Events\UpdateLiveChat;
use App\Modules\Questions\Http\Requests\QuestionRequest;
use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StoreQuestionController extends Controller
{
    public function __invoke(QuestionRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id ?: 0;

        event(new UpdateLiveChat(
            Question::create($data)
        ));

        return response()->json([
            'success' => 'Question submitted'
        ]);
    }
}
