<?php

namespace App\Modules\SupportChat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'type' => 'required',
            'api_token' => 'required',
        ];
    }
}
