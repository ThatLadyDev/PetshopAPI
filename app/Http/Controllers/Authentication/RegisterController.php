<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegistrationRequest;
use Illuminate\Http\JsonResponse;
use App\Actions\Auth\CreateUserAction;
use App\Actions\Auth\IssueJwtTokenAction;
use App\Http\Resources\UserResource;
use Exception;

class RegisterController extends Controller
{
    public function __invoke(UserRegistrationRequest $request, CreateUserAction $createUserAction, IssueJwtTokenAction $issueJwtTokenAction)
    {
        try{
            $user  = $createUserAction->execute($request->all(), $request->routeIs('admin.create'));
            $issueJwtTokenAction->execute($user);

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => new UserResource($user),
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch(Exception $e){
            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
