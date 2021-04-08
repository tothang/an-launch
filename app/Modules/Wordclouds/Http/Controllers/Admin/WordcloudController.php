<?php

namespace App\Modules\Wordclouds\Http\Controllers\Admin;

use App\Modules\Webinar\Models\Stream;
use App\Modules\Wordclouds\Http\Requests\WordcloudRequest;
use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WordcloudController extends Controller
{
    public function index(Stream $stream): View
    {
        return view('wordclouds::admin.index', [
            'stream' => $stream,
            'wordclouds' => $stream->wordclouds()->withTrashed()->with('entries')->get(),
        ]);
    }

    public function create(Stream $stream): View
    {
        return view('wordclouds::admin.create', [
            'stream' => $stream,
        ]);
    }

    public function store(WordcloudRequest $request, Stream $stream): RedirectResponse
    {
        $stream->wordclouds()->create($request->all());

        return redirect()->route('admin.wordclouds.index', [
            'stream' => $stream,
        ])->with('success', 'Wordcloud created!');
    }

    public function show(Wordcloud $wordcloud): View
    {
        $waiting = $wordcloud->entries()->waiting()->get();
        $accepted = $wordcloud->entries()->accepted()->get();
        $rejected = $wordcloud->entries()->rejected()->get();

        return view('wordclouds::admin.show', compact(
            'wordcloud',
            'waiting',
            'accepted',
            'rejected'
        ));
    }

    public function edit(Wordcloud $wordcloud): View
    {
        return view('wordclouds::admin.edit', [
            'wordcloud' => $wordcloud,
        ]);
    }

    public function update(WordcloudRequest $request, Wordcloud $wordcloud): RedirectResponse
    {
        $wordcloud->update($request->all());

        return redirect()->route('admin.wordclouds.index', [
            'stream' => $wordcloud->stream,
        ])->with('success', 'Wordcloud updated!');
    }

    public function destroy(Wordcloud $wordcloud): RedirectResponse
    {
        $wordcloud->delete();

        return redirect()->route('admin.wordclouds.index', [
            'stream' => $wordcloud->stream,
        ])->with('success', 'Wordcloud deleted!');
    }

    public function restore(Wordcloud $wordcloud): RedirectResponse
    {
        $wordcloud->restore();

        return redirect()->route('admin.wordclouds.index', [
            'stream' => $wordcloud->stream,
        ])->with('success', 'Wordcloud restored!');
    }
}
