<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\BreakoutRooms\Models\Breakout;
use App\Modules\Speakers\Models\Speaker;
use App\Modules\Webinar\Models\Stream;
use Illuminate\View\View;

class WebinarController extends Controller
{
    public function __invoke(?string $code = null)
    {
        $user = auth()->user();
        $stream = Stream::main();

        if ($user && $user->isDeclined()) {
            return redirect()->route('welcome');
        }

        // $segmentStreams = $user->segments()->with('streams')->get()->pluck('streams')->flatten();
        // $stream = $segmentStreams->where('code', $code)->first() ?: Stream::main();

        // if ($stream->recording_code && Config::getBoolFromCache('recording_mode')) {
        //     $answers = Answer::where('visible', 1)->get();
        //     $bookmarks = Bookmark::all();

        //     return view('webinar::on-demand.index', compact('user', 'answers', 'bookmarks', 'stream'));
        // }

        // if ($stream->is_external) {
        //     return view('webinar::stream.external', [
        //         'stream' => $stream,
        //     ]);
        // }

        $speakers = module_enabled('speakers') ? Speaker::getSelectOptions() : [];
        $breakouts = module_enabled('breakout-rooms') ? Breakout::all() : [];
        $embedCode = $stream->toArray()['embed_code_' . $user->locale] ?? '';

        return view('webinar::stream.internal', compact('user', 'speakers', 'breakouts', 'stream', 'embedCode'));
    }
}
