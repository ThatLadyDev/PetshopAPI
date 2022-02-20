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
    public function execute($request, $admin_path_bool)
    {
        $user = User::where('email', $request['email'])->firstOrFail();

        if (($user->is_admin !== true && $admin_path_bool === true) || ($user->is_admin === true && $admin_path_bool !== true)){
            throw new Exception('Unauthorized access');
        }

        if(!Hash::check($request['password'], $user->password)) {
            throw new Exception('Invalid Password');
        }

        return $user;
    }
}
