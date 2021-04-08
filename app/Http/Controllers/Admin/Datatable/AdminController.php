<?php

namespace App\Http\Controllers\Admin\Datatable;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return Datatables::of(Admin::all())
            ->addIndexColumn()
            ->addColumn('name', static function (Admin $admin): string {
                return $admin->name;
            })
            ->addColumn('role', static function (Admin $admin): string {
                return $admin->isRoot()
                    ? "<span class='badge badge-pill badge-dark'>Root</span>"
                    : "<span class='badge badge-pill badge-info'>Basic</span>";
            })
            ->addColumn('action', static function (Admin $admin): string {
                return view('admin.admins.partials.actions', compact('admin'))->render();
            })
            ->rawColumns(['role', 'action'])->make(true);
    }
}
