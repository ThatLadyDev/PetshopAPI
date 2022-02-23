<?php

namespace App\Actions\Auth;

use App\Services\JwtService;
use App\Actions\Auth\SaveJwtTokenToDatabaseAction;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class IssueJwtTokenAction
{
    public JwtService $jwtService;
    public SaveJwtTokenToDatabaseAction $saveJwtTokenToDatabaseAction;

    public function __construct(JwtService $jwtService, SaveJwtTokenToDatabaseAction $saveJwtTokenToDatabaseAction)
    {
        $this->jwtService = $jwtService;
        $this->saveJwtTokenToDatabaseAction = $saveJwtTokenToDatabaseAction;
    }

    public function execute(Authenticatable|null $user) : string
    {
        // @phpstan-ignore-next-line
        $token = $this->jwtService->issueToken($user->uuid)->toString();
        $this->saveJwtTokenToDatabaseAction->execute($user, $token);

        return $token;
    }
}
