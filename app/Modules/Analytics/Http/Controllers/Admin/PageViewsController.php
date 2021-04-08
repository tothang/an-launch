<?php

namespace App\Modules\Analytics\Http\Controllers\Admin;

use App\Modules\Analytics\Models\PageView;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageViewsController extends Controller
{
    public function __invoke(): View
    {
        $pageViews = PageView::countByUrl();

        return view('analytics::admin.page-views', compact('pageViews'));
    }
}
