<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Http\Requests\AnswerRequest;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizAnswer;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuiz;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AnswerController extends Controller
{
    public function index(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $answers = $pollAndQuizQuestion->answers()->withTrashed()->get();
        return view('polls-and-quizzes::admin.answers.index', compact('pollAndQuiz', 'pollAndQuizQuestion', 'answers'));
    }

    public function create(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {

        return view('polls-and-quizzes::admin.answers.create', compact('pollAndQuiz', 'pollAndQuizQuestion'));
    }

    public function store(AnswerRequest $request, PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $data = $request->all();
        $data['poll_and_quiz_question_id'] = $pollAndQuizQuestion->id;

        PollAndQuizAnswer::create($data);

        Session::flash('success', 'Answer Created');

        return redirect()->route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $pollAndQuizQuestion]);
    }

    public function edit(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion, PollAndQuizAnswer $pollAndQuizAnswer)
    {
        return view('polls-and-quizzes::admin.answers.edit', compact('pollAndQuiz', 'pollAndQuizQuestion', 'pollAndQuizAnswer'));
    }

    public function update(AnswerRequest $request, PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion, PollAndQuizAnswer $pollAndQuizAnswer)
    {
        $request->merge(['correct' => $request->correct ?: 0]);
        $pollAndQuizAnswer->update($request->all());

        Session::flash('success', 'Answer Updated');

        return redirect()->route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $pollAndQuizQuestion]);
    }

    public function destroy(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion, PollAndQuizAnswer $pollAndQuizAnswer)
    {
        $pollAndQuizAnswer->delete();

        Session::flash('success', 'Answer Deleted');

        return redirect()->route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $pollAndQuizQuestion]);
    }

    public function restore(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion, PollAndQuizAnswer $pollAndQuizAnswer)
    {
        $pollAndQuizAnswer->restore();

        Session::flash('success', 'Answer Restored');

        return redirect()->route('admin.poll-and-quiz.questions.answers.index', [$pollAndQuiz, $pollAndQuizQuestion]);
    }
}
