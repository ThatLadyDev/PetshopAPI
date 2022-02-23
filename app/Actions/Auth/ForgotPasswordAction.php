<?php

namespace App\Actions\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordAction
{
    /**
     * @throws Exception
     */
    public function execute(Request $request) : string
    {
        $user = Password::getUser($request->only('email'));
        if (is_null($user)) {
            throw new Exception(__(Password::INVALID_USER));
        }

        if (Password::getRepository()->recentlyCreatedToken($user)) {
            throw new Exception(__(Password::RESET_THROTTLED));
        }

        return Password::createToken($user);
    }
}
