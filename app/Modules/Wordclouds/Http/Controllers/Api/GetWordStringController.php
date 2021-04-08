<?php

namespace App\Modules\Wordclouds\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Wordclouds\Models\Wordcloud;

class GetWordStringController extends Controller
{
    public function __invoke(Wordcloud $wordcloud): string
    {
        $entries = $wordcloud->entries()->accepted()->get();

        $array = [];

        foreach ($entries as $entry) {
            if ($entry['count'] > 6) {
                $entry['count'] = $entry['count'] / 4 + 5;
            }
            $array[] = $entry['count'] . " " . $entry['word'];
        }

        return implode("\n" , $array);
    }
}
