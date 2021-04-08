<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmLanguageRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationLanguageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->is_confirmed_language) {
            return redirect()->route('welcome');
        }

        $language = User::LANGUAGES;
        $translatedLanguages = [];
        foreach ($language as $key => $lang) {
            $translatedLanguages[$key] = __('confirmation-language.language.' . $lang);
        }

        return view('confirmation-language', ['language' => $translatedLanguages]);
    }

    public function store(ConfirmLanguageRequest $request)
    {
        $data = $request->validated();

        User::where('id', Auth::user()->id)->update([
            'language' => $data['language'],
            'is_confirmed_language' => true,
        ]);

        return redirect()->route('welcome');
    }
}
