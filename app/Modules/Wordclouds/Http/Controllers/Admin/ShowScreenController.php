<?php

namespace App\Modules\Wordclouds\Http\Controllers\Admin;

use App\Modules\Wordclouds\Models\Wordcloud;
use App\Http\Controllers\Controller;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Illuminate\View\View;

class ShowScreenController extends Controller
{
    public function __invoke(Wordcloud $wordcloud): View
    {
        return view('wordclouds::screen.index', compact('wordcloud'));
    }
}
