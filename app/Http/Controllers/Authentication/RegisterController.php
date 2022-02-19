<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserRegistrationRequest;

class RegisterController extends Controller
{
    public function __invoke(UserRegistrationRequest $request)
    {
        return $request->all();
    }
}
