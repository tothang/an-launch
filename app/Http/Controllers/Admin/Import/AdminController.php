<?php

namespace App\Http\Controllers\Admin\Import;

use App\Admin;
use App\EnvX\Admin\AdminCreator;
use App\EnvX\Email\Mailer;
use App\Http\Controllers\Controller;
use App\EnvX\Database\AutoImport;
use App\Mail\AdminInvite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $importer;

    private $mailer;

    public function __construct(AutoImport $importer, Mailer $mailer)
    {
        $this->importer = $importer;
        $this->mailer = $mailer;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->importer
            ->using($request->file('import')->path())
            ->updateOrCreate(Admin::class, 'email', static function (): array {
                return AdminCreator::defaults();
            })
            ->then(function (Admin $admin): void {
                $this->mailer->send($admin, AdminInvite::class);
            });

        return back()->with('success', 'Import complete!');
    }
}
