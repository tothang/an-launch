<?php

namespace App\Modules\Social\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Social\Concerns\FiresSocialUpdateEvents;

class ToggleLikeController extends Controller
{
    use FiresSocialUpdateEvents;

    public function __invoke(string $likeableType, int $likeableId)
    {
        $user = request()->user();
        $model = app(module_class('social', 'Models\\'.$likeableType))::find($likeableId);

        $model->likedBy($user)
            ? $model->likes()->where('user_id', $user->id)->delete()
            : $model->likes()->create(['user_id' => $user->id]);

        $this->handleEvent($model);

        if (request()->ajax()) {
            return response()->json([], 200);
        }

        return back();
    }
}
