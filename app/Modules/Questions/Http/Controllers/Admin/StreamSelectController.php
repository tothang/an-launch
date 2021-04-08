<?php

namespace App\Modules\Questions\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StreamSelectController extends Controller
{
    public function __invoke(): View
    {
        return view('webinar::admin.streams.select', [
            'route' => 'admin.questions.index',
            'reference' => 'questions',
        ]);
    }
}
