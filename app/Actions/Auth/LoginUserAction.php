<?php

namespace App\Actions\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    /**
     * @throws Exception
     */
    public function execute($request)
    {
        $user = User::where('email', $request['email'])->firstOrFail();

        if(!Hash::check($request['password'], $user->password)) {
            throw new Exception('Invalid Password');
        }

        return $user;
    }
}
