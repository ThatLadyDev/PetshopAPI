<?php

namespace App\Actions\Auth;

use App\Services\JwtService;
use App\Actions\Auth\SaveJwtTokenToDatabaseAction;

class IssueJwtTokenAction
{

    public function __construct(JwtService $jwtService, SaveJwtTokenToDatabaseAction $saveJwtTokenToDatabaseAction)
    {
        $this->jwtService = $jwtService;
        $this->saveJwtTokenToDatabaseAction = $saveJwtTokenToDatabaseAction;
    }

    public function execute($user) : string
    {
        $token = $this->jwtService->issueToken($user->uuid)->toString();
        $this->saveJwtTokenToDatabaseAction->execute($user, $token);

        return $token;
    }
}
