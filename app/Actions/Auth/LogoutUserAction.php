<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Exception;

class LogoutUserAction
{
    public function execute($admin_path_bool) : void
    {
        if ((Auth::user()->is_admin !== true && $admin_path_bool === true) || (Auth::user()->is_admin === true && $admin_path_bool !== true)){
            throw new Exception('Unauthorized access');
        }

        Auth::user()->tokens()->delete();
        Auth::logout();
    }
}
