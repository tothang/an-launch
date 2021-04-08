<?php

namespace App\Modules\Notifications\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'segments' => 'required_if:is_global,0',
            'link' => 'required_if:type,link',
            'send_at' => 'date',
        ];
    }
}
