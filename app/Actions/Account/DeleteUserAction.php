<?php

namespace App\Actions\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteUserAction
{
    public function execute(): void
    {
        /** @var User */
        $user = Auth::user();
        $user->tokens()->delete();
        $user->delete();
        Auth::logout();
    }
}
