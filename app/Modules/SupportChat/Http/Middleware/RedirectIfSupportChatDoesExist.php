<?php

namespace App\Modules\SupportChat\Http\Middleware;

use App\Modules\SupportChat\Models\SupportChat;
use Closure;

class RedirectIfSupportChatDoesExist
{
    public function handle($request, Closure $next)
    {
        $brand = config('app.brand');

        $supportChat = SupportChat::where('brand', $brand)->first();

        if (! is_null($supportChat)) {
            return redirect()->route('admin.support-chat.edit', $supportChat);
        }

        return $next($request);
    }
}
