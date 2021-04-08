<?php
namespace App\Http\Controllers;

use App\Mail\Hyster\Invite as HysterInvite;
use App\Mail\Hyster\SaveTheDate as HysterSaveTheDate;
use App\Mail\PasswordReset;
use App\Mail\Reminder;
use App\Mail\Yale\DeclineInvitation as YaleDeclineInvitation;
use App\Mail\Hyster\DeclineInvitation as HysterDeclineInvitation;
use App\Mail\Yale\Invite as YaleInvite;
use App\Mail\Yale\SaveTheDate as YaleSaveTheDate;
use App\Modules\Registration\Mail\RegistrationConfirmation;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PreviewMailController extends Controller
{
    public function index(Request $request)
    {
        try {
            $userId = Crypt::decryptString($request->get('token') ?? '');
        } catch (DecryptException $decryptException) {
            return 'The token is not valid.';
        }

        $user = User::find($userId);
        if (!$user)
            return 'The token is not valid.';

        switch ($request->get('email_type') ?? '') {
            case 'invite-yale':
                return new YaleInvite($user);
                break;

            case 'invite-hyster':
                return new HysterInvite($user);
                break;

            case 'reminder':
                return new Reminder($user);
                break;

            case 'save-the-date-hyster':
                $user['is_preview'] = true;
                return new HysterSaveTheDate($user);
                break;

            case 'save-the-date-yale':
                $user['is_preview'] = true;
                return new YaleSaveTheDate($user);
                break;

            case 'registration-confirmation':
                return new RegistrationConfirmation($user);

            case 'password-reset':
                return new PasswordReset($user, 'token');

            case 'decline-invitation-yale':
                return new YaleDeclineInvitation($user);
                break;

            case 'decline-invitation-hyster':
                return new HysterDeclineInvitation($user);
                break;

            default:
                return 'Email preview is not supported for this email.';
        }
    }
}
