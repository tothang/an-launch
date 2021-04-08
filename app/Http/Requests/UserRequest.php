<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    private function getBrandFromRoute(): string
    {
        $path = Request::capture()->path();
        $group = strtolower(explode("/", $path)[2]);

        return $group === 'yale' ? User::BRAND_YALE : User::BRAND_HYSTER;
    }

    public function rules(): array
    {
        $rules = [
            'forename' => 'required',
            'surname' => 'required',
            'email' => ['required'],
            'title' => 'required',
            'role' => 'required',
            'brand' => 'required',
            'language' => 'required'
        ];

        if ($this->getBrandFromRoute() === User::BRAND_YALE) {
            $site = $this->route('yale') ? User::find($this->route('yale')) : null;
        } else {
            $site = $this->route('hyster') ? User::find($this->route('hyster')) : null;
        }

        if (!$site || ($site && $site->email !== $this->email)) {
            $rules['email'][] =
                Rule::unique('users')->where(function ($query) {
                    return $query->where('email', $this->email)
                       ->where('brand', $this->brand);
                });
        }

        return $rules;
    }
}
