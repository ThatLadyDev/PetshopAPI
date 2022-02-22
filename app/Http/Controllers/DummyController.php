<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JwtService;
use Lcobucci\JWT\Token\Plain;

class DummyController extends Controller
{
//    public function __construct()
//    {
//
//    }

    public function __invoke(JwtService $jwtService)
    {
        // TODO: Implement __invoke() method.
//        $token = $jwtService->issueToken();
//        return (['token' => $token->toString()]);

        return "hello and okay";
    }

//    public function testing()
//    {

//    }
}
