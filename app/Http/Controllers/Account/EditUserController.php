<?php

namespace App\Http\Controllers\Account;

use App\Actions\Account\EditUserAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    /**
     * @OA\Put(
     ** path="/api/v1/user/edit",
     *   tags={"User"},
     *   summary="Edit A User Account",
     *   operationId="userEdit",
     *   @OA\Parameter(name="first_name",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="last_name",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="email",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password_confirmation",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="is_marketing",in="query",required=false,allowEmptyValue=true,@OA\Schema(type="boolean")),
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(Request $request, EditUserAction $editUserAction): JsonResponse
    {
        try {
            $user = $editUserAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'error' => null,
                'data' => [
                    'user' => $user
                ],
                'errors' => [],
                'extra' => []
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
