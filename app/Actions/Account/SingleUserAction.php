<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;

class SingleUserAction
{
    public function execute()
    {
        return Auth::user();
    }
}
