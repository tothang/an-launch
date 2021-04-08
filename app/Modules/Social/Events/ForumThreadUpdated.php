<?php

namespace App\Modules\Social\Events;

use App\Modules\Social\Models\Comment;
use App\Modules\Social\Models\ForumThread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForumThreadUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread;

    public function __construct(ForumThread $thread, ?Comment $comment = null)
    {
        $this->thread = $thread->load(ForumThread::API_RELATIONS)->forPusher($comment);
    }

    public function broadcastOn(): Channel
    {
        return new Channel('forum');
    }

    public function broadcastAs(): string
    {
        return 'ForumThreadUpdated';
    }
}
