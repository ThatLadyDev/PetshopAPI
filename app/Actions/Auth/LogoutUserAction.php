<?php

namespace App\Actions\Auth;

use Exception;
use Illuminate\Support\Facades\Auth;

class LogoutUserAction
{
    public function execute(bool $admin_path_bool): void
    {
        // @phpstan-ignore-next-line
        if ((Auth::user()->is_admin !== true && $admin_path_bool === true) || (Auth::user(
                )->is_admin === true && $admin_path_bool !== true)) {
            throw new Exception('Unauthorized access');
        }

        // @phpstan-ignore-next-line
        Auth::user()->tokens()->delete();
        Auth::logout();
    }
}
