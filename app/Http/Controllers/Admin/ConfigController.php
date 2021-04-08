<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Http\Requests\ConfigRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ConfigController extends Controller
{
    public function index(): View
    {
        return view('admin.config.index', [
            'configs' => Config::all(),
        ]);
    }

    public function update(ConfigRequest $request, Config $config): RedirectResponse
    {
        Cache::forget("config_{$config->key}");

        $config->update($request->all());

        return redirect()->route('admin.config.index')
            ->with('success', 'Config updated!');
    }
}
