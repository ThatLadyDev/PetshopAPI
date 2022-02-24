<?php

namespace App\Actions\Account;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class SingleUserAction
{
    public function execute(): Authenticatable|null
    {
        return Auth::user();
    }
}
