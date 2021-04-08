<?php

namespace App\Modules\Agenda\Http\Controllers\Admin;

use App\Modules\Agenda\Http\Requests\AgendaRequest;
use App\Modules\Agenda\Models\AgendaItem;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        return view('agenda::admin.index', [
            'agendaItems' => AgendaItem::all(),
        ]);
    }

    public function create(): View
    {
        return view('agenda::admin.create');
    }

    public function store(AgendaRequest $request): RedirectResponse
    {
        AgendaItem::create(array_merge(
            $request->input(),
            ['datetime' => Carbon::parse($request->datetime)]
        ));

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda item created!');
    }

    public function edit(AgendaItem $agendaItem): View
    {
        return view('agenda::admin.edit', [
            'agendaItem' => $agendaItem,
        ]);
    }

    public function update(AgendaRequest $request, AgendaItem $agendaItem): RedirectResponse
    {
        $agendaItem->update(array_merge(
            $request->input(),
            ['datetime' => Carbon::parse($request->datetime)]
        ));

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda item updated!');
    }

    public function destroy(AgendaItem $agendaItem): RedirectResponse
    {
        $agendaItem->delete();

        return back()->with('success', 'Agenda item deleted!');
    }
}
