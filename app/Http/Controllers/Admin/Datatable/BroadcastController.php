<?php


namespace App\Http\Controllers\Admin\Datatable;


use App\Admin;
use App\Http\Controllers\Admin\Report\IndexController;
use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class BroadcastController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $brand = isYale() ? 'yale' : 'hyster';
        $table = DataTables::of(Stream::where('brand', $brand))
            ->addIndexColumn()
            ->addColumn('is_live_status', static function (Stream $stream): string {
                return $stream->isLive()
                    ? "<span class='badge badge-pill badge-success'>Yes</span>"
                    : "<span class='badge badge-pill badge-warning'>No</span>";
            })
            ->addColumn('action', static function (Stream $stream): string {
                //return '';
                return view('webinar::admin.streams.partials.actions', compact('stream'))->render();
            })
            ->rawColumns(['action', 'is_live_status'])
        ;

        return $table->make(true);
    }
}
