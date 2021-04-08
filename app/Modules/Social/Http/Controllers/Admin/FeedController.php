<?php

namespace App\Modules\Social\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Social\Concerns\FiresSocialUpdateEvents;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FeedController extends Controller
{
    use FiresSocialUpdateEvents;

    public function index(): View
    {
        return view('social::admin.feed.index', [
            'posts' => SocialPost::all(),
        ]);
    }

    public function create(): View
    {
        return view('social::admin.feed.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->handleEvent(SocialPost::create([
            'body' => $request->body,
            'pinned' => $request->has('pinned'),
            'image' => Str::after(optional($request->file('image'))->store('public/files'), 'public/'),
        ]));

        return redirect()->route('admin.social.feed.index')
            ->with('success', 'Social post created!');
    }

    public function show(SocialPost $post): View
    {
        return view('social::admin.feed.show', [
            'post' => $post,
        ]);
    }

    public function edit(SocialPost $post): View
    {
        return view('social::admin.feed.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, SocialPost $post): RedirectResponse
    {
        $this->handleEvent(tap($post)->update([
            'body' => $request->body,
            'pinned' => $request->has('pinned'),
            'image' => Str::after(optional($request->file('image'))->store('public/files'), 'public/'),
        ]));

        return redirect()->route('admin.social.feed.index')
            ->with('success', 'Social post updated!');
    }

    public function destroy(SocialPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.social.feed.index')
            ->with('success', 'Social post deleted!');
    }
}
