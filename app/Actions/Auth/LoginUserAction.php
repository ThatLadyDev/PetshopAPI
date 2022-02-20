<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    public function execute($request) : User
    {
        return User::where('email', $request['email'])->firstOrFail();

//        if (Hash::check($request->password, $user->password)) {
//            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
//            $response = ['token' => $token];
//            return response($response, 200);
//        }
//        else {
//            $response = ["message" => "Password mismatch"];
//            return response($response, 422);
//        }
//        }
//        else {
//            $response = ["message" =>'User does not exist'];
//            return response($response, 422);
//        }
    }
}
