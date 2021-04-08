<?php

namespace App\Modules\PollsAndQuizzes\Events;

use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TriggerQuestion implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $questionId;

    public $question;

    public $answers;

    public $multipleAnswers;

    public $holdingMessage;

    private $stream;

    public function __construct(PollAndQuizQuestion $question)
    {
        $this->stream = $question->quiz->stream;

        if ($question->active) {
            $this->questionId = $question->id;
            $this->question = $question->title;
            $this->answers = $question->answers()->get(['id', 'value']);
            $this->multipleAnswers = $question->multipleAnswers();
        } else {
            $this->holdingMessage = 'Please wait for the next question.';
        }
    }

    public function broadcastOn(): Channel
    {
        return new Channel('poll-quiz-question.' . $this->stream->id);
    }

    public function broadcastAs(): string
    {
        return 'TriggerQuestion';
    }
}
