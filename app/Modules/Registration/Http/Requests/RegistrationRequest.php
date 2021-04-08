<?php

namespace App\Modules\Registration\Http\Requests;

use App\Modules\Registration\Http\Requests\Admin\RegistrationRequest as AdminRegistrationRequest;

class RegistrationRequest extends AdminRegistrationRequest
{
    public function authorize(): bool
    {
        return $this->route()->parameter('registration')->is(
            auth()->user()->registration
        );
    }

    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'agree_and_register' => 'required',
            ]
        );
    }

    public function messages(): array
    {
        return array_merge(
            parent::messages(),
            [
                'reason_not_attending.required_if' => 'Please provide the reason you are not attending.',
                'agree_and_register.required' => "Please accept Privacy Policy as it's a required field."
            ]
        );
    }
}
