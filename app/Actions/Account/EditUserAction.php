<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EditUserAction
{
    public function execute($request) : User
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

        Auth::user()->update($request->except($except));
        return Auth::user();
    }
}
