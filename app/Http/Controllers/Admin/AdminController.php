<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\EmailLog;
use App\EnvX\Admin\AdminCreator;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Mail\AdminInvite;
use App\EnvX\Email\Mailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $mailer;

    private $creator;

    public function __construct(Mailer $mailer, AdminCreator $creator)
    {
        $this->mailer = $mailer;
        $this->creator = $creator;
    }

    public function index(): View
    {
        return view('admin.admins.index', [
            'admins' => Admin::all(),
            'emailLogs' => EmailLog::where('emailable_type', Admin::class)->get()
        ]);
    }

    public function create(): View
    {
        return view('admin.admins.create', [
            'roles' => Role::pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(AdminRequest $request): RedirectResponse
    {
        $this->mailer->send(
            $this->creator->create($request->input(), $request->role),
            AdminInvite::class
        );

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin created and invited!');
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.edit', [
            'roles' => Role::pluck('name', 'id')->toArray(),
            'admin' => $admin,
        ]);
    }

    public function update(AdminRequest $request, Admin $admin): RedirectResponse
    {
        tap($admin)->update($request->input())
            ->syncRoles([$request->role]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin updated!');
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin deleted!');
    }
}
