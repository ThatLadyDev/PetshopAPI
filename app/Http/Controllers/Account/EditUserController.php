<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Account\EditUserAction;

class EditUserController extends Controller
{
    public function __invoke(Request $request, EditUserAction $editUserAction) : JsonResponse
    {
        try {
            $user = $editUserAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'error'   => null,
                'data'    => [
                    'user' => $user
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
