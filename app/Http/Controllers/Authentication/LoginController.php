<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\IssueJwtTokenAction;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class LoginController extends Controller
{
    public function __invoke(UserLoginRequest $request, LoginUserAction $loginUserAction, IssueJwtTokenAction $issueJwtTokenAction): JsonResponse
    {
        try{
            $user  = $loginUserAction->execute($request->all(), $request->routeIs('admin.login'));
            $token = $issueJwtTokenAction->execute($user);

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'token' => $token
                ],
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch(Exception $e){
            if ($e instanceof ModelNotFoundException ){
                return new JsonResponse([
                    'success' => 0,
                    'data'    => [],
                    'error'   => 'Failed to authenticate user',
                    'errors'  => [],
                    'extra'   => []
                ], 422);
            }

            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
