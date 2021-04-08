<?php

namespace App\Exports;

use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserEngagement implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function query(): Builder
    {
        return User::with([
            'webinarEvents',
            'loginLogs',
            'streamingTimeLogs',
        ]);
    }

    public function map($model): array
    {
        return [
            $model->id,
            $model->email,
            $model->name,
            $model->loginLogs->isNotEmpty() ? 'Yes' : 'No',
            $model->loginLogs->count(),
            $model->startedStream($this->stream) ? 'Yes' : 'No',
            $model->getTotalStreamTime($this->stream),
        ];
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Email',
            'Name',
            'Has Logged in',
            'Login Count',
            'Started Stream',
            'Total Stream Time (minutes)',
        ];
    }
}
