<?php

namespace App\Modules\PollsAndQuizzes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollAndQuizQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
        ];
    }
}
