<?php

namespace App\Modules\Registration\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'forename' => 'required|safe',
            'surname' => 'required|safe',
            'email' => 'required|email:filter|safe',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
