<?php

namespace App\Modules\Wordclouds\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordcloudRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'question' => 'required',
            'character_limit' =>[
                'integer',
                'required',
                'max:255',
                'min:5',
            ]
        ];
    }
}
