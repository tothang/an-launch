<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Http\Requests\PollAndQuizQuestionRequest;
use App\Modules\PollsAndQuizzes\Http\Requests\QuestionRequest;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Http\Controllers\Controller;

use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index(PollAndQuiz $pollAndQuiz)
    {
        $questions = $pollAndQuiz->questions()->withTrashed()->get();
        return view('polls-and-quizzes::admin.questions.index', compact('questions', 'pollAndQuiz'));
    }

    public function show(PollAndQuiz $pollAndQuiz)
    {
        $questions = $pollAndQuiz->questions()->withTrashed()->get();
        return view('polls-and-quizzes::admin.questions.show', compact('questions', 'pollAndQuiz'));
    }

    public function create(PollAndQuiz $pollAndQuiz)
    {
        return view('polls-and-quizzes::admin.questions.create', compact('pollAndQuiz'));
    }

    public function store(PollAndQuizQuestionRequest $request, PollAndQuiz $pollAndQuiz)
    {
        $pollAndQuiz->questions()->create($request->all());

        Session::flash('success', 'Question Created');

        return redirect()->route('admin.poll-and-quiz.questions.index', $pollAndQuiz);
    }

    public function edit(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        return view('polls-and-quizzes::admin.questions.edit', compact('pollAndQuiz', 'pollAndQuizQuestion'));
    }

    public function update(PollAndQuizQuestionRequest $request, PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $pollAndQuizQuestion->update($request->all());

        Session::flash('success', 'Question Updated');

        return redirect()->route('admin.poll-and-quiz.questions.index', $pollAndQuiz);
    }

    public function destroy(PollAndQuiz $pollAndQuiz, PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $pollAndQuizQuestion->delete();

        Session::flash('success', 'Question Deleted');

        return redirect()->route('admin.poll-and-quiz.questions.index', $pollAndQuiz);
    }

    public function restore(PollAndQuiz $pollAndQuiz, int $id)
    {
        $pollAndQuizQuestion = PollAndQuizQuestion::withTrashed()->findOrFail($id);

        $pollAndQuizQuestion->restore();

        Session::flash('success', 'Question Restored');

        return redirect()->route('admin.poll-and-quiz.questions.index', $pollAndQuiz);
    }
}
