<?php

namespace App\Actions\Auth;

use App\Models\JwtToken;

class SaveJwtTokenToDatabaseAction
{
    public function execute($user, $token) : void
    {
        $user->token()->create([
            'unique_id'     => $token,
            'token_title'   => 'Petshop User'
        ]);
    }
}
