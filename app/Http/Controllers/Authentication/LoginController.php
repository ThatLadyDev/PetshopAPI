<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\IssueJwtTokenAction;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/user/login",
     *   tags={"User"},
     *   summary="Login A User Account",
     *   operationId="userLogin",
     *
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     * @OA\Post(
     ** path="/api/v1/admin/login",
     *   tags={"Admin"},
     *   summary="Login An Admin Account",
     *   operationId="adminLogin",
     *
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *)
     **/
    public function __invoke(UserLoginRequest $request, LoginUserAction $loginUserAction, IssueJwtTokenAction $issueJwtTokenAction) : JsonResponse
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
