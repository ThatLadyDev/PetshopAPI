<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Auth\LogoutUserAction;

class LogoutController extends Controller
{
    public function __invoke(Request $request, LogoutUserAction $logoutUserAction)
    {
        try {
            $logoutUserAction->execute($request->routeIs('admin.logout'));

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
