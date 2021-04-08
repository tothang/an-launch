<?php

namespace App\Modules\Social\Events;

use App\Modules\Social\Models\ForumTopic;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForumTopicUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $topic;

    public function __construct(ForumTopic $topic)
    {
        $this->topic = $topic->load(ForumTopic::PUSHER_RELATIONS)->forPusher();
    }

    public function broadcastOn(): Channel
    {
        return new Channel('forum');
    }

    public function broadcastAs(): string
    {
        return 'ForumTopicUpdated';
    }
}
