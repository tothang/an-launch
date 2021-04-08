<?php

namespace App\Http\Controllers\Admin\Email;

use App\EmailLog;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Queue;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $emailTemplates = collect(config('envx.emails'))->keys() ?? [];

        $returnEmailTemplates = [];
        foreach ($emailTemplates as $emailTemplate) {
            if (isHyster() && strpos($emailTemplate, 'hyster') !== false) {
                $returnEmailTemplates[] = $emailTemplate;
            }
            if (isYale() && strpos($emailTemplate, 'yale') !== false) {
                $returnEmailTemplates[] = $emailTemplate;
            }
            if (strpos($emailTemplate, 'yale') === false && strpos($emailTemplate, 'hyster') === false) {
                $returnEmailTemplates[] = $emailTemplate;
            }
        }

        return view('admin.emails.index', [
            'emails' => $returnEmailTemplates,
            'logs' => EmailLog::where('emailable_type', User::class)->get(),
            'onQueue' => Queue::size(config('envx.queues.emails')),
        ]);
    }
}
