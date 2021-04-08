<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Events\TriggerQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Http\Requests\PollAndQuizRequest;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Support\Facades\Session;

class PollAndQuizHostController extends Controller
{
    public function index(Stream $stream)
    {
        return view('polls-and-quizzes::admin.host.index', [
            'stream' => $stream,
            'polls' => $stream->pollsAndQuizzes()->withTrashed()->polls()->get()->sortByDesc('created_at'),
            'quizzes' => $stream->pollsAndQuizzes()->withTrashed()->quizzes()->get()->sortByDesc('created_at'),
        ]);
    }
}
