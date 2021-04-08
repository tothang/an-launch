<?php

namespace App\Modules\Social\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class DestroyPostImageController extends Controller
{
    public function __invoke(SocialPost $post): RedirectResponse
    {
        File::delete(tap($post)->update(['image' => null])->image);

        return back()->with('success', 'Post image deleted!');
    }
}
