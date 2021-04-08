<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Events\TriggerQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LeaderboardController extends Controller
{
    public function index(Stream $stream)
    {
        $quizQuestions = $stream->pollsAndQuizzes()->quizzes()->count();
        $users = User::leaderboardResults($stream);

        return view('polls-and-quizzes::admin.leaderboard.index', compact('users', 'quizQuestions', 'stream'));
    }
}
