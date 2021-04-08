<?php

namespace App\Modules\Social\Concerns;

use App\Modules\Social\Events\FeedUpdated;
use App\Modules\Social\Events\ForumThreadUpdated;
use App\Modules\Social\Events\ForumTopicUpdated;
use App\Modules\Social\Models\Comment;
use App\Modules\Social\Models\ForumThread;
use App\Modules\Social\Models\ForumTopic;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Database\Eloquent\Model;

trait FiresSocialUpdateEvents
{
    public function handleEvent(Model $model, ?Comment $comment = null): void
    {
        if ($model instanceof ForumThread) {
            event(new ForumThreadUpdated($model, $comment));

            $model = $model->topic;
        }

        if ($model instanceof ForumTopic) {
            event(new ForumTopicUpdated($model));
        }

        if ($model instanceof SocialPost) {
            event(new FeedUpdated($model, $comment));
        }
    }
}
