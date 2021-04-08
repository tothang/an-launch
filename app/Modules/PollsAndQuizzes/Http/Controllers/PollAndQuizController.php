<?php

namespace App\Modules\PollsAndQuizzes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\PollsAndQuizzes\Events\TriggerQuestion;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizQuestion;
use Illuminate\Support\Facades\Auth;

class PollAndQuizController extends Controller
{
    public function index()
    {
        $quizzes = PollAndQuiz::active()->get();
        return view('polls-and-quizzes::index', compact('quizzes'));
    }

    public function show(PollAndQuiz $quiz)
    {
        $question = $quiz->questions()->unanswered()->first();

        if($question === null){
            return redirect()->route('quiz.confirmation', $quiz);
        }

        $questionCount = $quiz->questions()->count();
        $userEntries = Auth::user()->quizResponses()->count();
        $left = $questionCount-$userEntries;

        return view('polls-and-quizzes::show', compact('quiz', 'question', 'questionCount', 'left'));
    }

    public function confirmation(PollAndQuiz $quiz)
    {
        $responses = $quiz->responses()->with(['question', 'answer'])->where('user_id', Auth::user()->id)->get();
        $correct =  $responses->filter(function($response){
            return $response->answer->correct;
        });

        if($correct->count() == $responses->count()){
            $allCorrect = true;
        }else{
            $allCorrect = false;
        }

        return view('polls-and-quizzes::confirmation', compact('quiz', 'responses', 'allCorrect'));
    }
}
