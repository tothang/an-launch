<?php

namespace App\Http\Controllers;

use App\EnvX\Email\Mailer;
use App\User;
use Illuminate\Http\Request;

class TestSendMailController extends Controller
{
    public function sendMailDeclineInvitation(Request $request)
    {
        $email = $request->input('email', '') ;

        /** @var \App\User|null */
        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return response()->json([
                'message' => 'data not found',
            ], 404);
        }

        // send mail
        $class = isHyster() ? \App\Mail\Hyster\DeclineInvitation::class : \App\Mail\Yale\DeclineInvitation::class;
        resolve(Mailer::class)->send($user, $class, [$user]);

        return response()->json([
            'success' => true
        ]);
    }
}
