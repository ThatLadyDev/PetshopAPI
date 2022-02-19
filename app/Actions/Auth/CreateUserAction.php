<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserAction
{
    public function execute($request)
    {
        User::create([
            'uuid'         => Str::uuid(),
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'is_marketing' => ($request->is_marketing === NULL) ? 0 : 1
        ]);
    }
}
