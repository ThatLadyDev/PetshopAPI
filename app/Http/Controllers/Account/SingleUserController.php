<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Account\SingleUserAction;
use Illuminate\Support\Js;
use App\Http\Resources\UserResource;

class SingleUserController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/user",
     *   tags={"User"},
     *   summary="Show A Currently Authenticated User's Account",
     *   operationId="userList",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(SingleUserAction $singleUserAction) : JsonResponse
    {
        try {
            $user = $singleUserAction->execute();

            return new JsonResponse([
                'success' => 1,
                "data"    => new UserResource($user),
                "error"   => null,
                "errors"  => [],
                "extra"   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse( ['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
