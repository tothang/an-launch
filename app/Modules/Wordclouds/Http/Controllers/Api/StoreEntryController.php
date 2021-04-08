<?php

namespace App\Modules\Wordclouds\Http\Controllers\Api;

use App\Modules\Wordclouds\Http\Requests\EntryRequest;
use App\Modules\Wordclouds\Models\Wordcloud;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StoreEntryController extends Controller
{
    public function __invoke(EntryRequest $request, int $wordcloud): JsonResponse
    {
        $entry = Wordcloud::find($wordcloud)->first()->createEntry($request->only('word'));
        $entry->userEntries()->create(['registration_id' => $request->get('user_id')]);

        return response()->json([
            'holding_message' => 'Thank you for your submission.'
        ]);
    }
}
