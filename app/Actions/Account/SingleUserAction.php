<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class SingleUserAction
{
    public function execute() : Authenticatable|null
    {
        return Auth::user();
    }
}
