<?php

namespace App\Exports;

use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PollsAndQuizzes implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function query(): Builder
    {
        return PollAndQuizResponse::query()->whereHas('question.quiz', function ($query) {
            $query->where('stream_id', $this->stream->id);
        });
    }

    public function map($model): array
    {
        return [
            $model->question->quiz->id,
            $model->question->id,
            isset($model->user) ? $model->user->id : 'N/A',
            isset($model->user) ? $model->user->name : 'N/A',
            isset($model->user) ? $model->user->email : 'N/A',
            $model->question->quiz->type,
            $model->question->quiz->name,
            $model->question->title,
            $model->answer->value,
            $model->answer->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Quiz #',
            'Question #',
            'User #',
            'Name',
            'Email',
            'Quiz Type',
            'Quiz Title',
            'Question',
            'Answer',
            'Created At',
        ];
    }
}
