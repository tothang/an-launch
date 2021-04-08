<?php

namespace App\Http\Controllers\Admin\Datatable;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __invoke(string $brand): JsonResponse
    {
        $relationships = ['loginLogs'];
        $table = Datatables::of(User::with($relationships)->where('brand', $brand))
            ->addIndexColumn()
            ->addColumn('name', static function (User $user) {
                return $user->name;
            })
            ->addColumn('dealership_name_or_employee_function', static function (User $user): ?string {
                return $user->getDealerShipNameOrEmployeeFunction();
            })
            ->addColumn('statusStringify', static function (User $user): ?string {
                return $user->status !== User::STATUS_DECLINED
                    ? $user->getStatusStringify()
                    : $user->getStatusStringify() . ' (Reason: ' . $user->declined_reason . ')';
            })
            ->addColumn('last_login', static function (User $user): ?string {
                return $user->loginLogs()->latest()->first() ? $user->loginLogs()->latest()->first()->created_at : '';
            })
            ->addColumn('action', static function (User $user) use ($brand): string {
                return view('admin.users.partials.actions', [
                    'brand' => $brand,
                    'user' => $user,
                    'brands' => User::BRANDS,
                    'titles' => User::TITLES
                ])->render();
            });

        return $table->rawColumns(array_merge(['action'], $registrationHeaders ?? []))->make(true);
    }
}
