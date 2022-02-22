<?php

namespace App\Actions\Auth;

use App\Models\JwtToken;

class SaveJwtTokenToDatabaseAction
{
    public function execute($user, $token) : void
    {
        $user->tokens()->create([
            'unique_id'     => $token,
            'token_title'   => 'Petshop User'
        ]);
    }
}
