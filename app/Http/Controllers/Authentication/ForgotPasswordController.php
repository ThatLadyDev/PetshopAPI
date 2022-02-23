<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Auth\ForgotPasswordAction;

class ForgotPasswordController extends Controller
{

    public function __invoke(Request $request, ForgotPasswordAction $forgotPasswordAction)
    {
        try {
            $token = $forgotPasswordAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'data'    => [
                    'reset_token' => $token
                ],
                'error'   => null,
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse( [
                'success' => 0,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
