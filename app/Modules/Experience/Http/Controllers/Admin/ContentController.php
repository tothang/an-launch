<?php

namespace App\Modules\Experience\Http\Controllers\Admin;

use App\Modules\Experience\Http\Requests\ContentRequest;
use App\Modules\Experience\Models\ExperienceContent;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class ContentController extends Controller
{
    public $route = 'admin.experience.content';

    public function __construct()
    {
        ViewFacade::share('route', 'admin.experience.content');
    }

    public function index(): View
    {
        return view('experience::admin.content.index', ['experienceTypes' => ExperienceContent::all()->groupBy('type')]);
    }

    public function create(): View
    {
        return view('experience::admin.content.create', ['types' => ExperienceContent::constByPrefix('TYPE')]);
    }

    public function store(ContentRequest $request): RedirectResponse
    {
        ExperienceContent::create($request->all());

        return redirect()->route('admin.experience.content.index');
    }

    Public function edit(ExperienceContent $experienceContent): View
    {
        return view('experience::admin.content.edit', [
            'content' => $experienceContent,
            'types' => ExperienceContent::constByPrefix('TYPE')
        ]);
    }
}
