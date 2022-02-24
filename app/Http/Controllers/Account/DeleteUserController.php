<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Account\DeleteUserAction;
use Exception;

class DeleteUserController extends Controller
{
    /**
     * @OA\Delete(
     ** path="/api/v1/user",
     *   tags={"User"},
     *   summary="Delete A User Account",
     *   operationId="userDelete",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(Request $request, DeleteUserAction $deleteUserAction) : JsonResponse
    {
        try {
            $deleteUserAction->execute();

            return new JsonResponse([
                'success' => 1,
                "data"    => [],
                "error"   => null,
                "errors"  => [],
                "extra"   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
