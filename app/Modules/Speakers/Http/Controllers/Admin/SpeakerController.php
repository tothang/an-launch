<?php

namespace App\Modules\Speakers\Http\Controllers\Admin;

use App\Modules\Speakers\Http\Requests\SpeakerRequest;
use App\Modules\Speakers\Models\Speaker;
use Exception;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class SpeakerController extends Controller
{
    public function index(): View
    {
        $speakers = Speaker::withTrashed()->sorted()->get();
        return view('speakers::admin.index', compact('speakers'));
    }

    public function create(): View
    {
        return view('speakers::admin.create');
    }

    public function store(SpeakerRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data['questionable'] = Arr::get($data, 'questionable', 0);
        $data['agendable'] = Arr::get($data, 'agendable', 0);

        if($request->file('image') !== null){
            $data['image'] = $request->file('image')->store('img/speakers', 'public');
        }

        Speaker::create($data);

        return redirect()->route('admin.speakers.index');
    }

    public function edit(Speaker $speaker): View
    {
        return view('speakers::admin.edit', compact('speaker'));
    }

    public function update(SpeakerRequest $request, Speaker $speaker): RedirectResponse
    {
        $data = $request->all();

        $data['questionable'] = Arr::get($data, 'questionable', 0);
        $data['agendable'] = Arr::get($data, 'agendable', 0);

        if($request->file('image') !== null){
            $data['image'] = $request->file('image')->store('img/speakers', 'public');
        }

        $speaker->update($data);
        return redirect()->route('admin.speakers.index');
    }

    public function destroy(Speaker $speaker): RedirectResponse
    {
        $speaker->delete();

        return redirect()->route('admin.speakers.index');
    }

    public function restore(Speaker $speaker): RedirectResponse
    {
        $speaker->restore();

        return redirect()->route('admin.speakers.index');
    }
}
