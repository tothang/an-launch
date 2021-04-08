<?php

namespace App\Modules\Wordclouds\Http\Controllers\Admin;

use App\Modules\Wordclouds\Models\Wordcloud;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModerationController extends Controller
{
    public function update(Request $request, WordcloudEntry $entry): RedirectResponse
    {
        $entry->update($request->all());

        return back();
    }
}
