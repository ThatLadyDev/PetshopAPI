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
    public function __invoke(SingleUserAction $singleUserAction)
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
