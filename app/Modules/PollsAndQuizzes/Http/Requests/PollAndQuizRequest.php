<?php

namespace App\Modules\PollsAndQuizzes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollAndQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:250',
            ],
            'description' => [
                'required',
                'max:250',
            ],
        ];
    }
}
