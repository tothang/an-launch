<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Dashboard implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('admin.reports.dashboard');
    }
}
