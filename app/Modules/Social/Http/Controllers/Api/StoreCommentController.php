<?php

namespace App\Modules\Social\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Social\Concerns\FiresSocialUpdateEvents;

class StoreCommentController extends Controller
{
    use FiresSocialUpdateEvents;

    public function __invoke(string $commentableType, int $commentableId)
    {
        $this->validate(request(), ['body' => 'safe']);

        $user = request()->user();
        $model = app(module_class('social', 'Models\\'.$commentableType))::find($commentableId);

        $comment = $model->comments()->create([
            'user_id' => $user->id,
            'body' => request('body')
        ]);

        $this->handleEvent($model, $comment);

        if (request()->ajax()) {
            return response()->json($comment->load('user'), 200);
        }

        return back();
    }
}
