<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AdminMenu
{
    public function compose(View $view): void
    {
        $menu = collect([
            [
                'title' => 'Dashboard',
                'route' => 'admin.dashboard',
                'activeOn' => 'admin.dashboard',
                'icon' => 'fas fa-tachometer-alt',
            ],
            [
                'title' => isHyster() ? 'Report - Hyster' : 'Report - Yale',
                'route' => 'admin.reports',
                'activeOn' => 'admin.reports',
                'icon' => 'fa fa-file',
            ],
        ]);

        if (module_enabled('analytics')) {
            $menu->push([
                'title' => 'Stats',
                'activeOn' => ['admin.analytics.*', 'admin.engagement*'],
                'icon' => 'fas fa-chart-line',
                'children' => [
                    [
                        'title' => 'Page Views',
                        'route' => 'admin.analytics.page-views',
                        'activeOn' => 'admin.analytics.page-views',
                        'icon' => 'far fa-eye',
                    ],
                    [
                        'title' => 'Engagement',
                        'route' => 'admin.engagement',
                        'activeOn' => 'admin.engagement*',
                        'icon' => 'fa fa-hand-pointer',
                    ],
                ],
            ]);
        }

        $menu->push([
            'isDivider' => true
        ]);

        if (module_enabled('speakers')) {
            $menu->push([
                'title' => 'Speakers',
                'route' => 'admin.speakers.index',
                'activeOn' => 'admin.speakers.*',
                'icon' => 'fa fa-user-tie',
            ]);
        }

        /*if (module_enabled('questions')) {
            $menu->push([
                'title' => 'Questions',
                'route' => 'admin.questions.select-stream',
                'activeOn' => 'admin.questions.*',
                'icon' => 'fa fa-comments',
            ]);
        }*/

        if (module_enabled('agenda')) {
            $menu->push([
                'title' => 'Agenda',
                'route' => 'admin.agenda.index',
                'activeOn' => 'admin.agenda.*',
                'icon' => 'fas fa-calendar-day',
            ]);
        }

        if (module_enabled('breakout-rooms')) {
            $menu->push([
                'title' => 'Breakouts',
                'route' => 'admin.breakouts.index',
                'activeOn' => 'admin.breakouts.*',
                'icon' => 'fa fa-bullseye',
            ]);
        }

        if (module_enabled('notifications')) {
            $menu->push([
                'title' => 'Notifications',
                'route' => 'admin.notifications.index',
                'activeOn' => 'admin.notifications.*',
                'icon' => 'fa fa-bell',
            ]);
        }

        if (module_enabled('social')) {
            $menu->push([
                'title' => 'Activity Feed',
                'route' => 'admin.social.feed.index',
                'activeOn' => 'admin.social.feed.*',
                'icon' => 'fa fa-grin-beam',
            ]);
        }

        if (module_enabled('social')) {
            $menu->push([
                'title' => 'Message Forum',
                'route' => 'admin.social.forum.index',
                'activeOn' => 'admin.social.forum.*',
                'icon' => 'fa fa-coffee',
            ]);
        }

        /*if (module_enabled('polls-and-quizzes')) {
            $menu->push([
                'title' => 'Polls and Quizzes',
                'route' => 'admin.poll-and-quiz.select-stream',
                'activeOn' => 'admin.poll-and-quiz.*',
                'icon' => 'far fa-chart-bar',
            ]);
        }*/

        if (module_enabled('wordclouds')) {
            $menu->push([
                'title' => 'Wordclouds',
                'route' => 'admin.wordclouds.select-stream',
                'activeOn' => 'admin.wordclouds.*',
                'icon' => 'fa fa-cloud',
            ]);
        }

        if (module_enabled('webinar')) {
            $menu->push([
                'title' => 'Broadcasts',
                'route' => 'admin.streams.index',
                'activeOn' => 'admin.streams.*',
                'icon' => 'fas fa-film',
            ]);
        }

        $menu->push([
            'isDivider' => true
        ]);

        if (is_root()) {
            $menu->push([
                'title' => 'Admins',
                'route' => 'admin.admins.index',
                'activeOn' => 'admin.admins.*',
                'icon' => 'fa fa-user-circle',
            ]);
        }

        if (isHyster()) {
            $menu->push([
                'title' => 'Hyster Delegates',
                'route' => 'admin.hyster.index',
                'activeOn' => 'admin.hyster*',
                'icon' => 'fas fa-users',
            ]);
            $menu->push([
                'title' => 'Hyster Notification',
                'route' => 'admin.notifications.index',
                'activeOn' => 'admin.notifications.*',
                'icon' => 'fa fa-bell',
            ]);
        }

        if (isYale()) {
            $menu->push([
                'title' => 'Yale Delegates',
                'route' => 'admin.yale.index',
                'activeOn' => 'admin.yale*',
                'icon' => 'fas fa-users',
            ]);
            $menu->push([
                'title' => 'Yale Notification',
                'route' => 'admin.notifications.index',
                'activeOn' => 'admin.notifications.*',
                'icon' => 'fa fa-bell',
            ]);
        }

        $menu->push([
            'title' => 'Emails',
            'route' => 'admin.emails',
            'activeOn' => 'admin.emails*',
            'icon' => 'far fa-paper-plane',
        ]);

        $menu->push([
            'title' => 'Configuration',
            'route' => 'admin.config.index',
            'activeOn' => 'admin.config.*',
            'icon' => 'fas fa-cogs',
        ]);

        if (module_enabled('support-chat')) {
            $menu->push([
                'title' => 'Support Chat',
                'route' => 'admin.support-chat.create',
                'activeOn' => 'admin.support-chat.*',
                'icon' => 'fa fa-info-circle',
            ]);
        }

        $menu->push([
            'isDivider' => true
        ]);

        $menu->push([
            'title' => 'Go to Front End',
            'route' => 'index',
            'activeOn' => 'index',
            'icon' => 'fas fa-mobile-alt',
        ]);

        $menu->push([
            'title' => 'Logout',
            'route' => 'admin.logout',
            'activeOn' => 'index',
            'icon' => 'fas fa-sign-out-alt',
        ]);

        $view->with('adminMenu', $menu);
    }
}
