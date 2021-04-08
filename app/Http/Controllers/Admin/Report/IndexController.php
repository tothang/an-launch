<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $title = isHyster() ? 'Hyster Report' : 'Yale Report';

        return view('admin.reports.index', [
            'title' => $title,
            'countDelegates' => self::getReportQuery()->count()
        ]);
    }

    public static function getReportQuery(): Builder
    {
        $brand = isHyster() ? User::BRAND_HYSTER : User::BRAND_YALE;

        return DB::table('users')
            ->join('streaming_time_logs', 'users.id', '=', 'streaming_time_logs.user_id')
            ->select('users.*', 'streaming_time_logs.view_time')
            ->where('users.brand', $brand);
    }
}
