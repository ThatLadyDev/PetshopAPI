<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Auth\ForgotPasswordAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/user/forgot-password",
     *   tags={"User"},
     *   summary="Forgot Password For A User Account",
     *   operationId="userForgotPassword",
     *
     *   @OA\Parameter(name="email",in="query",required=true,@OA\Schema(type="string")),
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(Request $request, ForgotPasswordAction $forgotPasswordAction): JsonResponse
    {
        try {
            $token = $forgotPasswordAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'data' => [
                    'reset_token' => $token
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
