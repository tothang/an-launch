<?php

namespace App\Modules\Questions\Http\Controllers\Admin;

use App\Modules\Questions\Http\Requests\FacilitateQuestionRequest;
use App\Modules\Questions\Models\Question;
use App\Http\Controllers\Controller;
use App\Modules\Speakers\Models\Speaker;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilitationController extends Controller
{
    public function index(Request $request, Stream $stream): View
    {
        $speakers = $request->get('speakers');

        if (module_enabled('speakers')) {
            $speakers = Speaker::getSelectOptions();
        }

        return view('questions::admin.facilitate.index', [
            'unreadQuestions' => $stream->questions()->forFacilitation($speakers)->unread()->get()->sortByDesc('likes'),
            'readQuestions' => $stream->questions()->forFacilitation($speakers)->read()->get()->sortByDesc('likes'),
            'speakers' => $speakers,
            'stream' => $stream
        ]);
    }

    public function update(FacilitateQuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->all());

        return redirect()->back();
    }

}
