<?php

namespace App\Actions\Auth;

use App\Models\JwtToken;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class SaveJwtTokenToDatabaseAction
{
    public function execute(Authenticatable|null $user, string $token): void
    {
        // @phpstan-ignore-next-line
        $user->tokens()->create([
            'unique_id' => $token,
            'token_title' => 'Petshop User'
        ]);
    }
}
