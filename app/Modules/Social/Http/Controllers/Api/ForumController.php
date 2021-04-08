<?php

namespace App\Modules\Social\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Social\Concerns\FiresSocialUpdateEvents;
use App\Modules\Social\Models\ForumTopic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    use FiresSocialUpdateEvents;

    public function index(ForumTopic $topic): JsonResponse
    {
        return response()->json(
            $topic->load(ForumTopic::API_RELATIONS)->forApi()
        );
    }

    public function store(Request $request, ForumTopic $topic): JsonResponse
    {
        $this->validate(request(), ['body' => 'safe']);

        $this->handleEvent($topic->threads()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]));

        return response()->json();
    }
}
