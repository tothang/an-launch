<?php

namespace App\Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Social\Models\ForumTopic;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        $forums = ForumTopic::with('threads', 'threads.comments')
            ->get()
            ->each(function ($topic) {
                $topic->commentCount = $topic->getCommentCount();
                $topic->withLastPost();
            });

        return view('social::forum.index', [
            'forumTopics' => $forums,
        ]);
    }

    public function show(ForumTopic $topic): View
    {
        return view('social::forum.show', [
            'topic' => $topic
        ]);
    }
}
