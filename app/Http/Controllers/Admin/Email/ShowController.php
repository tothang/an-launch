<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function __invoke(string $email): View
    {
        switch ($email) {
            case 'save-the-date-yale':
                $pageTitle = 'Email - ' . Str::ucfirst(User::BRAND_YALE) . ' - Save the date';
                break;

            case 'save-the-date-hyster':
                $pageTitle = 'Email - ' . Str::ucfirst(User::BRAND_HYSTER) . ' - Save the date';
                break;

            case 'invite-yale':
                $pageTitle = 'Email - Invitation - ' . Str::ucfirst(User::BRAND_YALE);
                break;

            case 'invite-hyster':
                $pageTitle = 'Email - Invitation - ' . Str::ucfirst(User::BRAND_HYSTER);
                break;

            case 'reminder':
                $pageTitle = 'Email - Reminders - ' . Str::ucfirst(config('app.brand') ?? '');
                break;

            case 'apology':
                $pageTitle = 'Email - Apology - ' . Str::ucfirst(config('app.brand') ?? '');
                break;

            default:
                $pageTitle = 'Emails - ' . Str::slug($email, ' ');
                break;
        }

        return view('admin.emails.show', [
            'email' => $email,
            'onQueue' => Queue::size(config('envx.queues.emails')),
            'pageTitle' => $pageTitle
        ]);
    }
}
