<?php

namespace App\Modules\Speakers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_admin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'image' => 'nullable|mimetypes:image/jpeg,image/png',
        ];
    }

    public function messages(): array
    {
        return [
            'image.mimetypes' => 'The speaker image must be a valid JPEG or PNG image file',
        ];
    }
}
