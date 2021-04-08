<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_root();
    }

    public function rules(): array
    {
        $rules = [
            'forename' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'role' => 'required',
        ];

        if (optional($this->route('admin'))->email !== $this->email) {
            $rules['email'][] = 'unique:admins,email';
        }

        return $rules;
    }
}
