<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleUserController extends Controller
{
    public function __invoke()
    {
        return "single user";
    }
}
