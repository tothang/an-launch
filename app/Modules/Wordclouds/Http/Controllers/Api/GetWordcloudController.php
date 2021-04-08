<?php

namespace App\Modules\Wordclouds\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Http\JsonResponse;

class GetWordcloudController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $wordcloud = Wordcloud::activeAndUnanswered(request()->user_id)->first();

        if ($wordcloud === null) {
            return response()->json([
                'holding_message' => 'Please wait for the next wordcloud.'
            ]);
        }

        $wordcloud->holding_message = '';

        return response()->json($wordcloud);
    }
}
