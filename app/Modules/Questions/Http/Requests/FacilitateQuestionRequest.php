<?php

namespace App\Modules\Questions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacilitateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'read' => [
                Rule::in(['1']),
            ],
            'on_screen' => [
                Rule::in(['1']),
            ],
            'hidden' => [
                Rule::in(['1', '0']),
            ],
        ];
    }
}
