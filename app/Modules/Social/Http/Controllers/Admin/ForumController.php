<?php

namespace App\Modules\Social\Http\Controllers\Admin;

use App\Modules\Social\Concerns\FiresSocialUpdateEvents;
use App\Modules\Social\Models\ForumTopic;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    use FiresSocialUpdateEvents;

    public function index(): View
    {
        return view('social::admin.forum.index', [
            'topics' => ForumTopic::all(),
        ]);
    }

    public function create(): View
    {
        return view('social::admin.forum.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->handleEvent(ForumTopic::create([
            'title' => $request->title,
            'pinned' => $request->has('pinned'),
        ]));

        return redirect()->route('admin.social.forum.index')
            ->with('success', 'Forum topic created!');
    }

    public function show(ForumTopic $topic): View
    {
        return view('social::admin.forum.show', [
            'topic' => $topic,
        ]);
    }

    public function edit(ForumTopic $topic): View
    {
        return view('social::admin.forum.edit', [
            'topic' => $topic,
        ]);
    }

    public function update(Request $request, ForumTopic $topic): RedirectResponse
    {
        $this->handleEvent(tap($topic)->update([
            'title' => $request->title,
            'pinned' => $request->has('pinned'),
        ]));

        return redirect()->route('admin.social.forum.index')
            ->with('success', 'Forum topic updated!');
    }

    public function destroy(ForumTopic $topic): RedirectResponse
    {
        $topic->delete();

        return redirect()->route('admin.social.forum.index')
            ->with('success', 'Forum topic deleted!');
    }
}
