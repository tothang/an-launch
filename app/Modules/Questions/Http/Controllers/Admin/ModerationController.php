<?php

namespace App\Modules\Questions\Http\Controllers\Admin;

use App\Modules\Questions\Events\QuestionModerated;
use App\Modules\Questions\Http\Requests\ModerateQuestionRequest;
use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModerationController extends Controller
{
    public function index(Request $request, Stream $stream): View
    {
        $speakers = $request->get('speakers');

        if (module_enabled('speakers')) {
            $speakers = Speaker::getSelectOptions();
        }

        return view('questions::admin.moderate.index', [
            'stream' => $stream,
            'speakers' => $speakers,
            'questions' => $stream->questions()->forModeration($speakers)->get()->sortByDesc('created_at'),
        ]);
    }

    public function update(ModerateQuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->all());

        event(new QuestionModerated($question));

        return redirect()->back();
    }

}
