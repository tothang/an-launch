<?php

namespace App\Modules\Social\Http\Controllers\Admin;

use App\Modules\Social\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DestroyCommentController extends Controller
{
    public function __invoke(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
