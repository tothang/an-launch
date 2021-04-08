<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPasswordRequest;
use App\Token;
use App\User;
use Illuminate\Http\Request;

class SetPasswordController extends Controller
{
    public function show(Request $request)
    {
        $msg = '';
        $token = Token::where('token', $request->get('token'))->first();

        if (!$token)
            return redirect()->route('login');

        if ($token) {

            if ($token->expires_at < date('Y-m-d H:i:s')) {
                $msg = 'create_password_url_invalid';
            }

            $user = User::find($token->tokenable_id);

            if (!$user) {
                $msg = 'create_password_url_invalid';
            } else {
                if (!in_array($user->status, [User::STATUS_NEW, User::STATUS_INVITED]) && empty($request->get('reset_password'))) {
                    return redirect()->route('login');
                }
            }
        }

        return view('auth.passwords.set-password', [
            'token' => $request->get('token'),
            'msg' => $msg
        ]);
    }

    /**
     * @param NewPasswordRequest $request
     */
    public function store(NewPasswordRequest $request)
    {
        $token = Token::where('token', $request->get('token'))->first();

        if (!$token) {
            $msg = $token ? 'create_password_url_invalid' : '';

            return view('auth.passwords.set-password', [
                'token' => $request->get('token'),
                'msg' => $msg
            ]);
        }

        $user = User::find($token->tokenable_id);

        $updateData = [
            'password' => bcrypt($request->password),
            'setup_complete' => 1,
            'first_login' => 1,
            'seen_onboarding' => 0
        ];

        if (in_array($user->status, [User::STATUS_NEW, User::STATUS_INVITED])) {
            $updateData['status'] = User::STATUS_PASSWORD_CREATED;
        }

        $user->update($updateData);
        $token->delete();

        return view('auth.passwords.set-password', [
            'msg_create_success' => 'password_created_successfully'
        ]);
    }
}
