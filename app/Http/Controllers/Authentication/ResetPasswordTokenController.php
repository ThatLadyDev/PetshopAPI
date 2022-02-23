<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordTokenController extends Controller
{
    public function __invoke()
    {
        return "reset password";
    }
}
