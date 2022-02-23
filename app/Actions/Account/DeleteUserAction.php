<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;

class DeleteUserAction
{
    public function execute()
    {
        // @phpstan-ignore-next-line
        Auth::user()->tokens()->delete();
        Auth::user()->delete();
        Auth::logout();
    }
}
