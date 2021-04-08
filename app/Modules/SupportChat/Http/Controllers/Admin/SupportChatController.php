<?php

namespace App\Modules\SupportChat\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\SupportChat\Http\Requests\SupportChatRequest;
use App\Modules\SupportChat\Models\SupportChat;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupportChatController extends Controller
{
    public function create(): View
    {
        return view('support-chat::admin.create', [
            'types' => SupportChat::constByPrefix('TYPE_'),
            'supportChat' => new SupportChat()
        ]);
    }

    public function store(SupportChatRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['brand'] = config('app.brand');
        $input['is_active'] = $input['is_active'] ?? false;

        $supportChat = SupportChat::create($input);

        return redirect()->route('admin.support-chat.edit', $supportChat)
            ->with('success', 'Support chat initialised!');
    }

    public function edit(SupportChat $supportChat): View
    {
        return view('support-chat::admin.edit', [
            'types' => SupportChat::constByPrefix('TYPE_'),
            'supportChat' => $supportChat
        ]);
    }

    public function update(SupportChat $supportChat, SupportChatRequest $request): RedirectResponse
    {
        $supportChat->update($request->all());

        return back()->with('success', 'Support chat updated!');
    }
}
