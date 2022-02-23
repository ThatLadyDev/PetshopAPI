<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Account\DeleteUserAction;

class DeleteUserController extends Controller
{
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
