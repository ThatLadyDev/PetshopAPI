<?php

namespace App\Actions\Auth;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public Guard $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @throws Exception
     */
    public function execute(array $request, bool $admin_path_bool): ?Authenticatable
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if ($this->guard->validate($credentials)) {
            // @phpstan-ignore-next-line
            if ((Auth::user()->is_admin !== true && $admin_path_bool === true) || (Auth::user(
                    )->is_admin === true && $admin_path_bool !== true)) {
                Auth::logout();
                throw new Exception('Unauthorized access');
            }
            return Auth::user();
        } else {
            throw new Exception('Invalid Credentials');
        }
    }
}
