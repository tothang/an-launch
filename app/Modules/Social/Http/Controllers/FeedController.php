<?php

namespace App\Modules\Social\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class FeedController extends Controller
{
    public function __invoke(): View
    {
        return view('social::feed.index');
    }
}
