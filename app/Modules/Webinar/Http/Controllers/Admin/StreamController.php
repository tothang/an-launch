<?php

namespace App\Modules\Webinar\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StreamController extends Controller
{
    public function index(): View
    {
        return view('webinar::admin.streams.select', [
            'title' => $this->getPageTitle(),
            'route' => 'admin.streams.edit',
        ]);
    }

    public function create(): View
    {
        return view('webinar::admin.streams.create', [
            'title' => $this->getPageTitle(),
        ]);
    }

    private function getPageTitle(): string
    {
        $brand = isYale() ? 'Yale' : 'Hyster';
        $title = 'Broadcasts - ' . $brand;
        return $title;
    }

    public function store(Request $request)
    {
        $fromRequest = $request->only(
            'is_live',
            'name',
            'code',
            'embed_type',
            'embed_code_en',
            'embed_code_de',
            'embed_code_fr',
            'embed_code_es',
            'embed_code_it',
            'embed_code_pl',
            'embed_code_ru',
            'embed_code_cs',
            'embed_code_nl'
        );
        $brand = isYale() ? Stream::BRAND_YALE : Stream::BRAND_HYSTER;
        $data = array_merge($fromRequest, ['brand' => $brand]);

        Stream::create($data);

        return redirect()->route('admin.streams.index')
            ->with('success', 'Broadcast created!');
    }

    public function edit(Stream $stream): View
    {
        return view('webinar::admin.streams.edit', [
            'stream' => $stream,
            'title' => $this->getPageTitle(),
        ]);
    }

    public function update(Request $request, Stream $stream): RedirectResponse
    {
        $data = $request->only(
            'name',
            'code',
            'embed_type',
            'embed_code_en',
            'embed_code_de',
            'embed_code_fr',
            'embed_code_es',
            'embed_code_it',
            'embed_code_pl',
            'embed_code_ru',
            'embed_code_cs',
            'embed_code_nl'
        );
        $isLive = $request->get('is_live') ?? 0;
        $stream->update(array_merge($data, ['is_live' => $isLive]));

        return redirect()->route('admin.streams.index')
            ->with('success', 'Broadcast updated!');
    }

    public function show(Stream $stream): View
    {
        return view('webinar::admin.streams.reports', [
            'stream' => $stream,
            'reports' => Stream::REPORTS,
        ]);
    }

    public function destroy(Request $request)
    {
        $stream = Stream::findOrFail($request->get('stream_id') ?? '');
        if ($stream) {
            $stream->delete();
        }

        return redirect()->route('admin.streams.index')
            ->with('success', 'Broadcast deleted!');
    }

}
