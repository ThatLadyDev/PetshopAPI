<?php

namespace App\Actions\Auth;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class LoginUserAction
{
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @throws Exception
     */
    public function execute($request, $admin_path_bool): ? Authenticatable
    {
        $credentials = [
            'email'     => $request['email'],
            'password'  => $request['password'],
        ];

        if($this->guard->validate($credentials, $admin_path_bool)) {
            if ((Auth::user()->is_admin !== true && $admin_path_bool === true) || (Auth::user()->is_admin === true && $admin_path_bool !== true)){
                Auth::logout();
                throw new Exception('Unauthorized access');
            }
            return Auth::user();
        }
        else{
            throw new Exception('Invalid Credentials');
        }
    }
}
