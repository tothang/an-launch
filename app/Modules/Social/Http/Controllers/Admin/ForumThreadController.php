<?php

namespace App\Modules\Social\Http\Controllers\Admin;

use App\Modules\Social\Concerns\FiresSocialUpdateEvents;
use App\Modules\Social\Models\ForumThread;
use App\Modules\Social\Models\ForumTopic;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ForumThreadController extends Controller
{
    use FiresSocialUpdateEvents;

    public function show(ForumTopic $topic, ForumThread $thread): View
    {
        return view('social::admin.forum.threads.show', [
            'topic' => $topic,
            'thread' => $thread,
        ]);
    }

    public function destroy(ForumTopic $topic, ForumThread $thread): RedirectResponse
    {
        $thread->delete();

        return redirect()->route('admin.social.forum.show', $topic)
            ->with('success', 'Forum thread deleted!');
    }
}
