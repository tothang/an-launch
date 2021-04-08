<?php

namespace App\Modules\Questions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModerateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in(['accepted', 'rejected']),
            ],
        ];
    }
}
