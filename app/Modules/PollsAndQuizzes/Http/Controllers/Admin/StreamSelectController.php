<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StreamSelectController extends Controller
{
    public function __invoke(): View
    {
        return view('webinar::admin.streams.select', [
            'route' => 'admin.poll-and-quiz.index',
            'reference' => 'polls and quizzes',
        ]);
    }
}
