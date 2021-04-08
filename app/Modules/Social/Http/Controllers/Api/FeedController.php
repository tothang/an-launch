<?php

namespace App\Modules\Social\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Social\Concerns\FiresSocialUpdateEvents;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedController extends Controller
{
    use FiresSocialUpdateEvents;

    public function index(): JsonResponse
    {
        return response()->json(
            SocialPost::with(SocialPost::API_RELATIONS)->latest()->get()->map->forApi()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate(request(), ['body' => 'safe']);

        $this->handleEvent(SocialPost::create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
            'image' => Str::after(optional($request->file('image'))->store('public/files'), 'public/'),
        ]));

        return response()->json();
    }
}
