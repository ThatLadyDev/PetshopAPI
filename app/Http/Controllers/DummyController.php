<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JwtService;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Token\Plain;

class DummyController extends Controller
{

    public function __invoke(JwtService $jwtService)
    {
        // TODO: Implement __invoke() method.
//        $token = $jwtService->issueToken();
//        return (['token' => $token->toString()]);

        return Auth::user();
    }

//    public function testing()
//    {

//    }
}
