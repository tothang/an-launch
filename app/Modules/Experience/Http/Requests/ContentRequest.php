<?php

namespace App\Modules\Experience\Http\Requests;

use App\Modules\Experience\Models\ExperienceContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ref' => 'required',
            'type' => [
                'required',
                Rule::in(ExperienceContent::constByPrefix('TYPE')),
            ],
            'name' => 'required',
            'body' => 'required',
        ];
    }
}
