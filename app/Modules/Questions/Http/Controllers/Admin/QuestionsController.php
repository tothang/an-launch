<?php

namespace App\Modules\Questions\Http\Controllers\Admin;

use App\Modules\Questions\Events\UpdateLiveChat;
use App\Modules\Questions\Http\Requests\QuestionRequest;
use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestionsController extends Controller
{
    public function index(Stream $stream): View
    {
        return view('questions::admin.manage.index', [
            'stream' => $stream,
            'questions' => $stream->questions->sortByDesc('created_at'),
        ]);
    }

    public function create(Stream $stream): View
    {
        $speakers = [];

        if (module_enabled('speakers')) {
            $speakers = Speaker::getSelectOptions();
        }

        return view('questions::admin.manage.create', compact('speakers', 'stream'));
    }

    public function store(QuestionRequest $request, Stream $stream): RedirectResponse
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id ?? 0;

        event(new UpdateLiveChat(
            $stream->questions()->create($data)
        ));

        return redirect()->route('admin.questions.index', $stream);
    }

    public function edit(Question $question): View
    {
        $speakers = [];

        if (module_enabled('speakers')) {
            $speakers = Speaker::getSelectOptions();
        }

        return view('questions::admin.manage.edit', [
            'question' => $question,
            'speakers' => $speakers,
        ]);
    }

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->all());
        return redirect()->route('admin.questions.index', [
            'stream' => $question->stream,
        ]);
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->back();
    }
}
