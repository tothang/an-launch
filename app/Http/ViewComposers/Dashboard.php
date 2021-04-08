<?php

namespace App\Http\ViewComposers;

use App\EmailLog;
use App\Modules\Analytics\Models\PageView;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use App\Modules\Questions\Models\Question;
use App\Modules\Registration\Models\UserRegistration;
use App\Modules\Social\Models\Comment;
use App\Modules\Social\Models\ForumThread;
use App\Modules\Social\Models\Like;
use App\Modules\Social\Models\SocialPost;
use App\Modules\Webinar\Models\WebinarEvent;
use App\User;
use Illuminate\View\View;

class Dashboard
{
    public function compose(View $view): void
    {
        $items = collect([
            // [
            //     'title' => 'Visited site',
            //     'stat' => User::has('loginLogs')->count() . '/' . User::count(),
            //     'icon' => 'fa fa-eye',
            // ],
            // [
            //     'title' => 'Pages viewed',
            //     'stat' => PageView::count(),
            //     'icon' => 'fa fa-eye',
            //     'route' => 'admin.analytics.page-views'
            // ],
            // [
            //     'title' => 'Total user activity',
            //     'stat' => floor(PageView::sum('time_spent') / 3600) . ' hrs',
            //     'icon' => 'fa fa-hourglass-half',
            // ],
            // [
            //     'title' => 'Total stream views',
            //     'stat' => WebinarEvent::started()->count(),
            //     'icon' => 'fa fa-film',
            // ],
            // [
            //     'title' => 'Questions asked',
            //     'stat' => Question::count(),
            //     'icon' => 'fa fa-comments',
            // ],
            // [
            //     'title' => 'Questions answered',
            //     'stat' => Question::read()->count(),
            //     'icon' => 'fa fa-comments',
            // ],
            [
                    'title' => 'Total of delegates',
                    'stat' => User::whereIn('brand',User::BRANDS)->count(),
                    'icon' => 'fa fa-eye',
            ],
            [
                'title' => 'No. of Invites sent',
                'stat' => EmailLog::count(),
                'icon' => 'fa fa-mail-bulk',
            ],
            [
                'title' => 'No. of Delegates declined',
                'stat' => User::where('status', User::STATUS_DECLINED)->count(),
                'icon' => 'fa fa-hourglass-half',
            ],
            [
                'title' => 'No. of Delegates registered',
                'stat' => User::where('status', User::STATUS_REGISTERED)->count(),
                'icon' => 'fa fa-chart-bar',
            ],
        ]);

        // if (PollAndQuiz::count()) {
        //     $items->push([
        //         'title' => 'Poll/quiz shown',
        //         'stat' => PollAndQuiz::answered()->count(),
        //         'icon' => 'fa fa-chart-bar',
        //     ]);
        //     $items->push([
        //         'title' => 'Poll/quiz responses',
        //         'stat' => PollAndQuizResponse::count(),
        //         'icon' => 'fa fa-chart-bar',
        //     ]);
        // }

        if (module_enabled('social')) {
            $items->push([
                'title' => 'Forum threads',
                'stat' => ForumThread::count(),
                'icon' => 'fa fa-coffee',
            ]);
            $items->push([
                'title' => 'Social posts',
                'stat' => SocialPost::count(),
                'icon' => 'fa fa-grin-beam',
            ]);
            $items->push([
                'title' => 'Total likes',
                'stat' => Like::count(),
                'icon' => 'fa fa-heart',
            ]);
            $items->push([
                'title' => 'Total comments',
                'stat' => Comment::count(),
                'icon' => 'fa fa-comment-alt',
            ]);
        }

        if (module_enabled('registration')) {
            $items->push([
                'title' => 'Users invited',
                'stat' => User::invited()->count(),
                'icon' => 'fa fa-mail-bulk',
            ]);
            $items->push([
                'title' => 'Users registered',
                'stat' => UserRegistration::registered()->count(),
                'icon' => 'fa fa-check',
            ]);
            $items->push([
                'title' => 'Users attending',
                'stat' => UserRegistration::attending()->count(),
                'icon' => 'fa fa-thumbs-up',
                'type' => 'success',
            ]);
            $items->push([
                'title' => 'Users not attending',
                'stat' => UserRegistration::notAttending()->count(),
                'icon' => 'fa fa-thumbs-down',
                'type' => 'danger',
            ]);
        }

        $view->with('dashboardItems', $items);
    }
}
