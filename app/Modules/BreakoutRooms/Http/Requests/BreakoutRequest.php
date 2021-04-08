<?php

namespace App\Modules\BreakoutRooms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreakoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:5',
            'link' => 'required|url',
        ];
    }
}
