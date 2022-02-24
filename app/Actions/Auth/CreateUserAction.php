<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserAction
{
    public function execute(array $request, bool $admin_path_bool): User
    {
        return User::create([
            'uuid' => Str::uuid(),
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'is_admin' => ($admin_path_bool === false) ? 0 : 1,
            'password' => Hash::make($request['password']),
            'is_marketing' => ($request['is_marketing'] === null) ? 0 : 1,
        ]);
    }
}
