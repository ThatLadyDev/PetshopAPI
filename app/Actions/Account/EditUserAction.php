<?php

namespace App\Actions\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;

class EditUserAction
{
    public function execute(Request $request) : User|null
    {
        $except = ['uuid'];
        foreach ($request->all() as $key => $value){
            if ($value === null){
                $except[] = $key;
            }
            else{
                ($key === 'password') ? $request->merge(['password' => Hash::make($value)]) : null;
            }
        }

        // @phpstan-ignore-next-line
        Auth::user()->update($request->except($except));
        return Auth::user();
    }
}
