<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\ResetPasswordTokenRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordTokenAction
{
    public function execute(ResetPasswordTokenRequest $request): void
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw new Exception(__($status));
        }
    }
}
