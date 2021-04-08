<?php

namespace App\Modules\Questions\Events;

use App\Modules\Questions\Models\Question;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateLiveChat implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $question;

    public function __construct(Question $question)
    {
        $this->question = $question->getItemForLiveChat();;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('questions');
    }

    public function broadcastAs(): string
    {
        return 'UpdateLiveChat';
    }
}
