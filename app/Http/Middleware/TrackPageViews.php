<?php

namespace App\Http\Middleware;

use App\Modules\Analytics\Models\PageView;
use Closure;
use Illuminate\Http\Request;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_ENV') === 'testing') {
            return $next($request);
        }

        if (is_admin()) {
            return $next($request);
        }

        if (auth()->check()) {
            PageView::create([
                'user_id' => $request->user()->id,
                'url' => $request->path(),
            ]);
        }

        return $next($request);
    }
}
