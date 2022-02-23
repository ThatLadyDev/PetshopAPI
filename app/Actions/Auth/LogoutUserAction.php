<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Exception;

class LogoutUserAction
{
    public function execute(bool $admin_path_bool) : void
    {
        // @phpstan-ignore-next-line
        if ((Auth::user()->is_admin !== true && $admin_path_bool === true) || (Auth::user()->is_admin === true && $admin_path_bool !== true)){
            throw new Exception('Unauthorized access');
        }

        // @phpstan-ignore-next-line
        Auth::user()->tokens()->delete();
        Auth::logout();
    }
}
