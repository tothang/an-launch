<?php

namespace App\Modules\Social\Events;

use App\Modules\Social\Models\Comment;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(SocialPost $post, ?Comment $comment = null)
    {
        $this->post = $post->load(SocialPost::API_RELATIONS)->forPusher($comment);
    }

    public function broadcastOn(): Channel
    {
        return new Channel('feed');
    }

    public function broadcastAs(): string
    {
        return 'FeedUpdated';
    }
}
