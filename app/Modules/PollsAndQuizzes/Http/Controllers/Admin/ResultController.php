<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers\Admin;

use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use App\Modules\PollsAndQuizzes\Models\Question;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function show(PollAndQuizQuestion $pollAndQuizQuestion)
    {
        $colours = collect([
            '#fff',
            '#fff',
            '#fff',
            '#fff',
            '#fff',
            '#fff',
            '#fff',
            '#fff',
        ]);

        return view('polls-and-quizzes::admin.graphs.bar', compact('pollAndQuizQuestion', 'colours'));
    }

}
