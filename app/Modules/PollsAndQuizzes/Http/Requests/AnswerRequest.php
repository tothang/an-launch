<?php

namespace App\Modules\PollsAndQuizzes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'value' => 'required',
        ];
    }
}
