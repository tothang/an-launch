<?php


namespace App\Http\Controllers\Admin\Datatable;


use App\Http\Controllers\Admin\Report\IndexController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $delegates = IndexController::getReportQuery()->get();

        $table = DataTables::of($delegates)
            ->addIndexColumn()
            ->addColumn('name', static function ($delegate) {
                return $delegate->forename." ".$delegate->surname;
            })
            ->addColumn('email', static function ($delegate) {
                return $delegate->email;
            })
            ->addColumn('brand', static function ($delegate) {
                return $delegate->brand ?  $delegate->brand : '';
            })
            ->addColumn('role', static function ($delegate) {
                return $delegate->role ? $delegate->role : '';
            })
            ->addColumn('view_time', static function ($delegate) {
                return gmdate("H:i:s", $delegate->view_time);
            });

        return $table->make(true);
    }
}