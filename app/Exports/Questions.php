<?php

namespace App\Exports;

use App\Modules\Questions\Models\Question;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Questions implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function query(): Builder
    {
        return Question::query()->where('stream_id', $this->stream->id);
    }

    public function map($model): array
    {
        return [
            $model->id,
            isset($model->user) ? $model->user->id : 'N/A',
            isset($model->user) ? $model->user->name : 'N/A',
            isset($model->user) ? $model->user->email : 'N/A',
            $model->from,
            $model->to,
            $model->question,
            $model->read ? 'Yes' : 'No',
            $model->on_screen ? 'Yes' : 'No',
            $model->status,
            $model->hidden ? 'Yes' : 'No',
            $model->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Question #',
            'User #',
            'Name',
            'Email',
            'From',
            'To',
            'Question',
            'Read',
            'On Screen',
            'Status',
            'Hidden',
            'Created At',
        ];
    }
}
