<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Events\TriggerScore;
use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use Illuminate\Http\RedirectResponse;

class ScoreController extends Controller
{
    public function show(PollAndQuiz $pollAndQuiz): RedirectResponse
    {
        event(new TriggerScore($pollAndQuiz));

        return back()->with('success', 'User scores visible!');
    }

}
