<?php

namespace App\Exports;

use App\Modules\Analytics\Models\PageView as PageViewModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PageViews implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection(): Collection
    {
        return PageViewModel::countByUrl();
    }

    public function headings(): array
    {
        return [
            'URI',
            'Total visits',
            'Total time spent (Minutes)'
        ];
    }
}
