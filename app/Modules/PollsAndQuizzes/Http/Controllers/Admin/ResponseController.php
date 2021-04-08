<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ResponseController extends Controller
{
    public function index(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion): View
    {
        $responses = $pollAndQuizQuestion->responses;

        return view('polls-and-quizzes::admin.responses.index', compact('pollAndQuiz', 'pollAndQuizQuestion', 'responses'));
    }

    public function destroy(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion, PollAndQuizResponse $pollAndQuizResponse): RedirectResponse
    {
        $pollAndQuizResponse->delete();

        return redirect()->route('admin.poll-and-quiz.questions.responses.index', [$pollAndQuiz, $pollAndQuizQuestion]);
    }

}
