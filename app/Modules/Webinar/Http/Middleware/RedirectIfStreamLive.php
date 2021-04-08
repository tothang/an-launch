<?php

namespace App\Modules\Webinar\Http\Middleware;

use App\Modules\Webinar\Models\Stream;
use Closure;
use Illuminate\Http\Request;

class RedirectIfStreamLive
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\User */
        $user = $request->user();

        // force redirect to welcome page if user status is password created
        if ($user->isPasswordCreated()) {
            return redirect()->route('welcome');
        }

        $segmentStreams = $user->segments()->with('streams')->get()->pluck('streams')->flatten();
        $stream = $segmentStreams->where('code', $request->route('code'))->first() ?: Stream::main();

        if ((bool) $stream->is_live) {
            return redirect()->route('webinar');
        }

        return $next($request);
    }
}
