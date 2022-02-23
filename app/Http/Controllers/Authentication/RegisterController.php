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
    /**
     * @OA\Post(
     ** path="/api/v1/user/create",
     *   tags={"User"},
     *   summary="Create A User Account",
     *   operationId="userCreate",
     *   @OA\Parameter(name="first_name",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="last_name",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password_confirmation",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="is_marketing",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="boolean")),
     *
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     * @OA\Post(
     ** path="/api/v1/admin/create",
     *   tags={"Admin"},
     *   summary="Create An Admin Account",
     *   operationId="adminCreate",
     *   @OA\Parameter(name="first_name",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="last_name",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password_confirmation",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="is_marketing",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="boolean")),
     *
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *)
     **/
    public function __invoke(UserRegistrationRequest $request, CreateUserAction $createUserAction, IssueJwtTokenAction $issueJwtTokenAction) : JsonResponse
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
