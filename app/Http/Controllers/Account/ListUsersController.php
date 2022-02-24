<?php

namespace App\Http\Controllers\Account;

use App\Actions\Account\ListUsersAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class ListUsersController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/admin/user-listing",
     *   tags={"Admin"},
     *   summary="List All Users Accounts",
     *   operationId="userList",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     **/
    public function __invoke(ListUsersAction $listUsersAction): JsonResponse
    {
        try {
            $users = $listUsersAction->execute();
            return new JsonResponse([
                'success' => 1,
                'error' => null,
                'data' => [
                    'users' => $users,
                ],
                'errors' => [],
                'extra' => []
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
