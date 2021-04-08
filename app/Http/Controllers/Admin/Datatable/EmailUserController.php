<?php

namespace App\Http\Controllers\Admin\Datatable;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class EmailUserController extends Controller
{
    public function __invoke(string $email): JsonResponse
    {
        $mailable = config("envx.emails.{$email}");
        $sent = User::withEmail(class_basename($mailable))->get();
        $brand = config('app.brand') ?? '';
        $segments = request()->segments();
        $emailType = end($segments) ?? '';

        $where = [
            'brand' => $brand,
        ];

        if ($emailType === 'reminder') {
            $where['status'] = [User::STATUS_INVITED, User::STATUS_PASSWORD_CREATED];
        }

        $data = $mailable::recipients()->where($where);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('selected', static function (User $user) use ($sent): string {
                return $sent->contains($user)
                    ? ''
                    : "<input type='checkbox' name='selected' class='js-add-to-selection' data-id='{$user->id}'>";
            })
            ->addColumn('name', static function (User $user): string {
                return $user->name ?? '';
            })
            ->addColumn('language', static function (User $user): string {
                return $user->language ?? '';
            })
            ->addColumn('action', static function (User $user) use ($sent, $email): string {
                return view('admin.emails.partials.actions', compact('user', 'sent', 'email'))->render();
            })
            ->rawColumns(['selected', 'action'])->make(true);
    }
}
