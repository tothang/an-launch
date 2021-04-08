<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Http\Requests\PollAndQuizRequest;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PollAndQuizController extends Controller
{
    public function index(Stream $stream): View
    {
        $polls = $stream->pollsAndQuizzes()->withTrashed()->polls()->get()->sortByDesc('created_at');
        $quizzes = $stream->pollsAndQuizzes()->withTrashed()->quizzes()->get()->sortByDesc('created_at');

        return view('polls-and-quizzes::admin.index', [
            'stream' => $stream,
            'polls' => $polls,
            'quizzes' => $quizzes,
        ]);
    }

    public function create(Stream $stream): View
    {
        return view('polls-and-quizzes::admin.create', [
            'stream' => $stream,
            'types' => PollAndQuiz::$types,
        ]);
    }

    public function store(PollAndQuizRequest $request, Stream $stream): RedirectResponse
    {
        $stream->pollsAndQuizzes()->create($request->all());

        return redirect()->route('admin.poll-and-quiz.index', $stream)
            ->with('success', 'Poll/Quiz created!');
    }

    public function edit(PollAndQuiz $pollAndQuiz): View
    {
        return view('polls-and-quizzes::admin.edit', [
            'pollAndQuiz' => $pollAndQuiz,
            'types' => PollAndQuiz::$types,
        ]);
    }

    public function update(PollAndQuizRequest $request, PollAndQuiz $pollAndQuiz): RedirectResponse
    {
        $pollAndQuiz->update($request->all());

        return redirect()->route('admin.poll-and-quiz.index', [
            'stream' => $pollAndQuiz->stream,
        ])->with('success', 'Poll/Quiz updated!');
    }

    public function destroy(PollAndQuiz $pollAndQuiz): RedirectResponse
    {
        $pollAndQuiz->delete();

        return redirect()->route('admin.poll-and-quiz.index', [
            'stream' => $pollAndQuiz->stream,
        ])->with('success', 'Poll/Quiz deleted!');
    }

    public function restore(PollAndQuiz $pollAndQuiz): RedirectResponse
    {
        $pollAndQuiz->restore();

        return redirect()->route('admin.poll-and-quiz.index', [
            'stream' => $pollAndQuiz->stream,
        ])->with('success', 'Poll/Quiz restored!');
    }
}
