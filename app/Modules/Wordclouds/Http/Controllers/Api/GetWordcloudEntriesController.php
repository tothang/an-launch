<?php

namespace App\Modules\Wordclouds\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Wordclouds\Models\Wordcloud;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Illuminate\Http\JsonResponse;

class GetWordcloudEntriesController extends Controller
{
    public function __invoke(Wordcloud $wordcloud): WordcloudEntry
    {
        return $wordcloud->entries()->accepted()->inRandomOrder()->first();
    }
}
