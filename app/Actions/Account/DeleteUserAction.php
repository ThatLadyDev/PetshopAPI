<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeleteUserAction
{
    public function execute() : void
    {
        /** @var User */
        $user = Auth::user();
        $user->tokens()->delete();
        $user->delete();
        Auth::logout();
    }
}
