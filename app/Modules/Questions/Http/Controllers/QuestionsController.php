<?php

namespace App\Modules\Questions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Questions\Http\Requests\QuestionRequest;
use App\Modules\Questions\Models\Question;
use App\Modules\Speakers\Models\Speaker;

class QuestionsController extends Controller
{
    public function create()
    {
        $breakoutMode = Helper::checkConfig('questions_breakout_mode', true);

        if(module_enabled('speakers')){
            $speakers = Speaker::questionable()
                ->byDay(1)
                ->orderBy('position')
                ->get();
            return view('questions::create', compact('speakers', 'breakoutMode'));
        }
        return view('questions::create', compact('breakoutMode'));
    }

    public function store(QuestionRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user() !== null ? $request->user()->id : 0;

        Question::create($data);

        return redirect()->route('questions.confirmation');
    }

    public function confirmation()
    {
        return view('questions::confirmation');
    }
}
