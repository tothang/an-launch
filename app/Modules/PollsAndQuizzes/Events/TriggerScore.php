<?php

namespace App\Modules\PollsAndQuizzes\Events;

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TriggerScore implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $stream;

    public function __construct(PollAndQuiz $quiz)
    {
        $this->stream = $quiz->stream;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('poll-quiz-question.' . $this->stream->id);
    }

    public function broadcastAs(): string
    {
        return 'TriggerScore';
    }
}
