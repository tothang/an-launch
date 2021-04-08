<?php

namespace App\Modules\Agenda\Http\Controllers;

use App\Modules\Agenda\Models\AgendaItem;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        return view('agenda::index', [
            'agendaGroups' => AgendaItem::all()->groupBy->date
        ]);
    }
}
