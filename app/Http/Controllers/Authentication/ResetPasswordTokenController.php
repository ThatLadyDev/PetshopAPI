<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Auth\ResetPasswordTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordTokenRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ResetPasswordTokenController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/user/reset-password-token",
     *   tags={"User"},
     *   summary="Reset Password For A User Account",
     *   operationId="userResetPassword",
     *
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="token",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Parameter(name="password_confirmation",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(
        ResetPasswordTokenRequest $request,
        ResetPasswordTokenAction $resetPasswordTokenAction
    ): JsonResponse {
        try {
            $resetPasswordTokenAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'data' => [
                    'message' => 'Password has been successfully updated'
                ],
                'error' => null,
                'errors' => [],
                'extra' => []
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
