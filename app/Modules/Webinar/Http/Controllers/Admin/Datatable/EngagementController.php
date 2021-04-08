<?php

namespace App\Modules\Webinar\Http\Controllers\Admin\Datatable;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class EngagementController extends Controller
{
    public function __invoke(Stream $stream): JsonResponse
    {
        return Datatables::of(User::with('loginLogs', 'streamingTimeLogs')->get())
            ->addIndexColumn()
            ->addColumn('email', static function (User $user): string {
                return $user->email;
            })
            ->addColumn('progress', static function (User $user) use ($stream): string {
                $loggedIn = $user->loginLogs->count()
                    ? "<span class='badge badge-info'>Has logged in</span>"
                    : "<span class='badge badge-danger'>Hasn't logged in</span>";

                if ($user->finishedStream($stream)) {
                    return $loggedIn . " <span class='badge badge-success'>Stream finished</span>";
                }

                if ($user->startedStream($stream)) {
                    return $loggedIn . " <span class='badge badge-warning'>Stream started</span>";
                }

                return $loggedIn . " <span class='badge badge-danger'>Stream not started</span>";
            })
            ->addColumn('stream_time', static function (User $user) use ($stream): string {
                return $user->getTotalStreamTime($stream);
            })
            ->addColumn('last_login', static function (User $user): string {
                return $user->getLastLogin();
            })
            ->rawColumns(['progress', 'logged_in'])->make(true);
    }
}
