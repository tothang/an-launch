<?php

namespace App\Modules\Questions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from' => [
                'required',
                'safe',
            ],
            'question' => [
                'required',
                'min:5',
                'safe',
            ],
        ];
    }
}
