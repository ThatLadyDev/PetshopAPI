<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ResetPasswordTokenRequest;
use App\Actions\Auth\ResetPasswordTokenAction;

class ResetPasswordTokenController extends Controller
{
    public function __invoke(ResetPasswordTokenRequest $request, ResetPasswordTokenAction $resetPasswordTokenAction)
    {
        try {
            $resetPasswordTokenAction->execute($request);

            return new JsonResponse([
                'success' => 1,
                'data'    => [
                    'message' => 'Password has been successfully updated'
                ],
                'error'   => null,
                'errors'  => [],
                'extra'   => []
            ], 200);
        }
        catch (Exception $e){
            return new JsonResponse([
                'success' => 0,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
