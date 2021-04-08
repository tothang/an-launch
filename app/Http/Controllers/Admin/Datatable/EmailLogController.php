<?php

namespace App\Http\Controllers\Admin\Datatable;

use App\EmailLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class EmailLogController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $key = request('search')['value'] ?? null;

        $data = EmailLog::where('type', 'like', "%$key%")
            ->orWhereHasMorph('emailable', '*', function ($query) use ($key) {
                $query->where('forename', 'like', "%$key%")->orWhere('surname', 'like', "%$key%");
            })
            ->with('emailable')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('type', static function (EmailLog $log): string {
                return display_classname($log->type);
            })
            ->addColumn('user', static function (EmailLog $log): string {
                return $log->emailable->name;
            })
            ->addColumn('opened_at', static function (EmailLog $log): string {
                return $log->opened ? $log->updated_at : '';
            })->make(true);
    }
}
