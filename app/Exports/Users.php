<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Users implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $withRegistration;

    public function __construct()
    {
        $this->withRegistration = module_enabled('registration');
    }

    public function query(): Builder
    {
        return $this->withRegistration ? User::query() : User::with('registration');
    }

    public function map($model): array
    {
        return array_merge([
            $model->id,
            $model->forename,
            $model->surname,
            $model->email,
            $model->setup_complete ? 'Yes' : 'No',
            $model->seen_onboarding ? 'Yes' : 'No',
        ], $this->withRegistration
            ? $this->mapRegistration($model->registration)
            : []
        );
    }

    public function headings(): array
    {
        return array_merge([
            '#',
            'Forename',
            'Surname',
            'Email',
            'Setup Complete',
            'Seen Onboarding',
        ], $this->withRegistration
            ? $this->registrationHeaders()
            : []
        );
    }

    private function mapRegistration($model): array
    {
        return [
            $model->status,
            $model->attending ? 'Yes' : 'No',
            $model->attending ? 'N/A' : $model->reason_not_attending,
            $model->registered_at,
        ];
    }

    private function registrationHeaders(): array
    {
        return [
            'Registration Status',
            'Attending?',
            'Reason not attending',
            'Registered at',
        ];
    }
}
