<?php

namespace App\Modules\Wordclouds\Http\Controllers\Admin;

use App\Modules\Wordclouds\Http\Requests\EntryRequest;
use App\Modules\Wordclouds\Models\Wordcloud;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EntryController extends Controller
{
    public function create(Wordcloud $wordcloud): View
    {
        return view('wordclouds::admin.entries.create', compact('wordcloud'));
    }

    public function store(EntryRequest $request, Wordcloud $wordcloud): RedirectResponse
    {
        $wordcloud->createEntry($request->all());

        return redirect()->route('admin.wordclouds.show', compact('wordcloud'));
    }
}
