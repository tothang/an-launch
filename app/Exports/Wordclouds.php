<?php

namespace App\Exports;

use App\Modules\Webinar\Models\Stream;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Wordclouds implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function query(): Builder
    {
        return WordcloudEntry::query()->whereHas('wordcloud', function ($query) {
            $query->where('stream_id', $this->stream->id);
        });
    }

    public function map($model): array
    {
        return [
            $model->id,
            $model->wordcloud->id,
            $model->wordcloud->question,
            $model->word,
            $model->count,
            $model->status,
            $model->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Wordcloud #',
            'Entry #',
            'Question',
            'Word',
            'Count',
            'Status',
            'Created At'
        ];
    }
}
