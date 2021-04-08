<?php

namespace App\Modules\BreakoutRooms\Http\Controllers\Admin;

use App\Modules\BreakoutRooms\Http\Requests\BreakoutRequest;
use App\Modules\BreakoutRooms\Models\Breakout;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BreakoutController extends Controller
{
    public function index(): View
    {
        return view('breakout-rooms::admin.index', [
            'breakouts' => Breakout::all(),
        ]);
    }

    public function create(): View
    {
        return view('breakout-rooms::admin.create');
    }

    public function store(BreakoutRequest $request): RedirectResponse
    {
        Breakout::create($request->input());

        return redirect()->route('admin.breakouts.index')
            ->with('success', 'Breakout room created!');
    }

    public function edit(Breakout $breakout): View
    {
        return view('breakout-rooms::admin.edit', [
            'breakout' => $breakout,
        ]);
    }

    public function update(BreakoutRequest $request, Breakout $breakout): RedirectResponse
    {
        $breakout->update($request->input());

        return redirect()->route('admin.breakouts.index')
            ->with('success', 'Breakout room updated!');
    }

    public function destroy(Breakout $breakout): RedirectResponse
    {
        $breakout->delete();

        return redirect()->route('admin.breakouts.index')
            ->with('success', 'Breakout room deleted!');
    }
}
