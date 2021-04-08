<?php

namespace App\Modules\Questions\Events;

use App\Modules\Questions\Models\Question;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionModerated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $questionId;

    public function __construct(Question $question)
    {
        $this->questionId = $question->id;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('questions');
    }

    public function broadcastAs(): string
    {
        return 'QuestionModerated';
    }
}
