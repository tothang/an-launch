<?php

namespace App\Modules\Questions\Http\Controllers\Admin;

use App\Modules\Questions\Models\Answer;
use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use League\Csv\Reader;

class AnswersController extends Controller
{
    public function index(Stream $stream): View
    {
        return view('questions::admin.answers.index', [
            'stream' => $stream,
            'answers' => $stream->answers,
        ]);
    }

    public function create(Stream $stream): View
    {
        return view('questions::admin.answers.create', [
            'stream' => $stream,
        ]);
    }

    public function store(Request $request, Stream $stream): RedirectResponse
    {
        $data = $request->all();
        $data['visible'] = Arr::get($data, 'visible', 0);

        $stream->answers()->create($data);

        return redirect()->route('admin.questions.answers.index', [
            'stream' => $stream,
        ]);
    }

    public function edit(Answer $answer): View
    {
        return view('questions::admin.answers.edit', compact('answer'));
    }

    public function update(Request $request, Answer $answer): RedirectResponse
    {
        $data = $request->all();
        $data['visible'] = Arr::get($data, 'visible', 0);

        $answer->update($data);

        return redirect()->route('admin.questions.answers.index', [
            'stream' => $answer->stream,
        ]);
    }

    public function destroy(Answer $answer): RedirectResponse
    {
        $answer->delete();

        return redirect()->back();
    }

    public function import(Request $request, Stream $stream): RedirectResponse
    {
        $csv = Reader::createFromPath($request->file('import')->path());
        $imports = $csv->setHeaderOffset(0)->getRecords();

        $errors = [];

        foreach($imports as $import)
        {
            if($stream->answers()->where('question', $import['question'])->first() !== null){
                $errors[] = $import['question'];
                continue;
            }

            $stream->answers()->create($import);
        }

        if(!empty($errors)){
            Session::flash('danger', "Some imports failed! \r\n".implode(",\r\n", $errors));
        }else{
            Session::flash('success', 'All answers imported.');
        }

        return redirect()->back();
    }
}
