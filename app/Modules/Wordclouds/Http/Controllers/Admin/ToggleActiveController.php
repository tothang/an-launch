<?php

namespace App\Modules\Wordclouds\Http\Controllers\Admin;

use App\Modules\Wordclouds\Events\TriggerWordcloud;
use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToggleActiveController extends Controller
{
    public function __invoke(Request $request, Wordcloud $wordcloud): RedirectResponse
    {
        $wordcloud->update($request->all());

        event(new TriggerWordcloud($wordcloud));

        return redirect()->route('admin.wordclouds.index', [
            'stream' => $wordcloud->stream,
        ])->with('success', 'Wordcloud state updated!');
    }
}
