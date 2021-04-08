<?php

namespace App\Modules\Wordclouds\Events;

use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TriggerWordcloud implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $wordcloud;

    public function __construct(Wordcloud $wordcloud)
    {
        $wordcloud->holding_message = '';

        if ($wordcloud->active === false) {
            $wordcloud->holding_message = 'Please wait for the next question.';
        }

        $this->wordcloud = $wordcloud;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('wordclouds.' . $this->wordcloud->stream_id);
    }

    public function broadcastAs(): string
    {
        return 'TriggerWordcloud';
    }
}
