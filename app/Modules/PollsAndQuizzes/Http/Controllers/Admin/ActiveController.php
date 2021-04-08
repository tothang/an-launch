<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Events\TriggerQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ActiveController extends Controller
{
    public function update(Request $request, PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $pollAndQuiz->setQuestionsInactive();
        $pollAndQuizQuestion->update($request->all());

        event(new TriggerQuestion($pollAndQuizQuestion));

        return redirect()->route('admin.poll-and-quiz.questions.index', $pollAndQuiz);
    }
}
