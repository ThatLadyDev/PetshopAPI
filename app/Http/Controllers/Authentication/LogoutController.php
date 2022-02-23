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
    /**
     * @OA\Get(
     ** path="/api/v1/user/logout",tags={"User"},summary="Logout A User Account",operationId="userLogout",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *),
     * @OA\Get(
     ** path="/api/v1/admin/logout",tags={"Admin"},summary="Logout A User Account",operationId="userLogout",
     *
     *   @OA\Response(response=200,description="Success"),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\Response(response=404,description="Page Not found"),
     *   @OA\Response(response=422,description="Unprocessable Entity")
     *)
     **/
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
