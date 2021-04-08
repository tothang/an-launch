<?php

namespace App\Modules\Wordclouds\Http\Controllers;

use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WordcloudController extends Controller
{
    public function index(): View
    {
        $registration = auth()->user()->registrations->first();
        $wordcloud = Wordcloud::active()->sorted()->get()->first();

        return view('wordclouds::index', compact('wordcloud', 'registration'));
    }

    public function show(Wordcloud $wordcloud): View
    {
        return view('wordclouds::show', compact('wordcloud'));
    }
}
