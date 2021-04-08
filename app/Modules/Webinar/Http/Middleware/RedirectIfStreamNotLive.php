<?php

namespace App\Modules\Webinar\Http\Middleware;

use App\Modules\Webinar\Models\Stream;
use Closure;
use Illuminate\Http\Request;

class RedirectIfStreamNotLive
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\User */
        $user = $request->user();
        $segmentStreams = $user->segments()->with('streams')->get()->pluck('streams')->flatten();
        $stream = $segmentStreams->where('code', $request->route('code'))->first() ?: Stream::main();

        // force redirect to welcome page if user status is password created
        if ($user->isPasswordCreated()) {
            return redirect()->route('welcome');
        }

        if ((bool) $stream->is_live === false) {
            return redirect()->route('holding');
        }

        return $next($request);
    }
}
