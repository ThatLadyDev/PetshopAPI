<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Actions\Account\ListUsersAction;
use App\Http\Resources\UserResource;

class ListUsersController extends Controller
{
    public function __invoke(ListUsersAction $listUsersAction) : JsonResponse
    {
        try {
            $users = $listUsersAction->execute();
            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'users' => $users,
                ],
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse(['success' => 0, 'error' => $e->getMessage()], 500);
        }
    }
}
